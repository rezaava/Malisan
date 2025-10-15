<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PHPUnit\Util\Exception;

class Checkout extends Model
{

    const STATUS_SUCCESS = 200;

    const URL_CHECKOUT = "https://nextpay.org/nx/gateway/checkout";

    public static function makeCheckout($order): CheckoutResult
    {

        $checkoutPrice = round($order->price * (100 - $order->discount_percent) / 100);
        $checkoutPrice = $checkoutPrice - $order->checkouts->where('code', Checkout::STATUS_SUCCESS)->sum('price');
        if ($checkoutPrice <= 0) {
            $order->status = Order::STATUS_CLOSED;
            $order->save();
            return CheckoutResult::createResult(CheckoutResult::STATUS_NOTHING_PAY);
        }

        if (!$order->shop->checkout_sheba){
            return CheckoutResult::createResult(CheckoutResult::STATUS_ERROR_SHEBA_NULL);
        }

        DB::beginTransaction();
        try {

            $checkout = new Checkout();
            $checkout->order_id = $order->id;
            $checkout->price = $checkoutPrice;
            $checkout->paid_account = $order->shop->checkout_sheba;
            $checkout->save();

            $response = Http::post(self::URL_CHECKOUT, [
                'auth' => env("NEXTPAY_CHECKOUT_API", ''),
                'wid' => env("NEXTPAY_CHECKOUT_WID", ''),
                'amount' => $checkoutPrice,
                'sheba' => $order->shop->checkout_sheba,
                'name' => $order->shop->checkout_name,
                'tracker' => 'checkout-'.$checkout->id,
                'currency' => 'IRT',
            ]);

            $checkout->code = $response->object()->code;
            $checkout->message = $response->object()->message;
            $checkout->save();

            DB::commit();
            return CheckoutResult::createResult(CheckoutResult::STATUS_SUCCESS, '', $checkout);

        } catch (Exception $e) {
            DB::rollBack();
            return CheckoutResult::createResult(CheckoutResult::STATUS_ERROR, 'خطایی در تصفیه حساب پیش آمد!');
        }

    }

    public function isSuccessful() {
        return $this->code == self::STATUS_SUCCESS;
    }

}

class CheckoutResult {

    const STATUS_NOTHING_PAY = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_ERROR = 2;
    const STATUS_ERROR_SHEBA_NULL = 3;

    public $status;
    public $message;
    public $checkout;

    public static function createResult($status, $message = "", $checkout = null) {
        $result = new CheckoutResult();
        $result->status = $status;
        $result->message = $message;
        $result->checkout = $checkout;
        return $result;
    }

}
