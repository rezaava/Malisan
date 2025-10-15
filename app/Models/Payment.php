<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Matrix\Exception;

class Payment extends Model
{

    const URL_GET_TOKEN = 'https://nextpay.org/nx/gateway/token';
    const URL_VERIFY = 'https://nextpay.org/nx/gateway/verify';

    const CODE_SUCCESS_PAID = 0;
    const CODE_PENDING = -1;
    const CODE_ERROR_BANK = -2;
    const CODE_WAITING_BANK = -3;
    const CODE_CANCELED = -4;

    const codeMessages = [
        self::CODE_SUCCESS_PAID => 'پرداخت با موفقیت انجام شده است.',
        self::CODE_PENDING => 'در انتظار پرداخت کاربر',
        self::CODE_ERROR_BANK => 'مشکلی با بانک پذیرنده پیش آمده است',
        self::CODE_WAITING_BANK => 'منتظر تایید بانک پذیرنده',
        self::CODE_CANCELED => 'پرداخت لغو شده است'
    ];

    public function getCodeMessage(): string
    {
        try {
            return self::codeMessages[$this->code];
        } catch (Exception $e) {
            return 'خطای فنی پیش آمده است';
        }
    }

    public function isSuccessful() {
        return $this->code == self::CODE_SUCCESS_PAID;
    }

    /*
     * Start of a payment: creating a payment token
     */
    public static function createPaymentToken($order, $paymentPrice = null, $description = '') {

        $price = $order->price;
        if ($paymentPrice) {
            $price = $paymentPrice;
        }

        DB::beginTransaction();
        try {
            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->price = $price;
            $payment->save();

            $response = Http::post(self::URL_GET_TOKEN, [
                'api_key' => env("NEXTPAY_API_KEY", ''),
                'order_id' => $order->id,
                'amount' => $price,
                'callback_uri' => route('payment.commit', ['paymentId' => $payment->id]),
                'customer_phone' => $order->user->mobile,
                'payer_name' => $order->user->name.' '.$order->user->family,
                'payer_desc' => $description,
            ]);

            $payment->code = $response->object()->code;
            $payment->save();
            if ($response->object()->code == -1){
                $payment->trans_id = $response->object()->trans_id;
                $payment->save();
            } else {
                DB::rollBack();
                return null;
            }

            DB::commit();
            return $payment;
        } catch (Exception $e) {
            DB::rollBack();
            return null;
        }

    }

    /*
     * Verify and get Details of payment
     */
    public function verifyPayment() {
        DB::beginTransaction();
        try {
            $response = Http::post(self::URL_VERIFY, [
                'api_key' => env("NEXTPAY_API_KEY", ''),
                'trans_id' => $this->trans_id,
                'amount' => $this->price,
            ]);

            $this->code = $response->object()->code;
            $this->card_holder = $response->object()->card_holder;
            $this->customer_phone = $response->object()->customer_phone;
            $this->Shaparak_Ref_Id = $response->object()->Shaparak_Ref_Id;
            $this->date = $response->object()->created_at;
            $this->save();
            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /*
     * init relation to Order model
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
