<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Matrix\Exception;

class Transaction extends Model
{

    protected $fillable = ['user_id', 'type', 'price', 'description', 'order_id'];

    const TYPE_BUY_FROM_SHOP = 1;
    const TYPE_DAILY_COMMISSION = 2;
    const TYPE_CORRECTIVE = 2;

    const PRICE_DAILY_COMMISSION = 10000;

    /*
     * make transaction
     * NOTE: for every transaction you should use this method;
     * NOTE: price will add to wallet, so if use buys something price should be minus;
     */
    public static function makeTransaction($user, $type, $price, $description, $orderId = null): TransactionResult
    {

        if ($price < 0 && $user->wallet < abs($price)) {
            return TransactionResult::create(TransactionResult::STATUS_INSUFFICIENT_WALLET);
        }

        DB::beginTransaction();
        try {

            $transaction = Transaction::create([
                'user_id' => $user->id,
                'type' => $type,
                'price' => $price,
                'description' => $description,
                'order_id' => $orderId,
            ]);
            $transaction->save();
            $user->wallet = $user->wallet + $price;
            $user->save();

            if ($user->wallet < 0) {
                DB::rollBack();
                return TransactionResult::create(TransactionResult::STATUS_INSUFFICIENT_WALLET);
            }

            DB::commit();
            return TransactionResult::create(TransactionResult::STATUS_SUCCESS, '', $transaction);

        } catch (Exception $ex) {
            DB::rollBack();
            return TransactionResult::create(TransactionResult::STATUS_DATABASE_ERROR);
        }

    }

    /*
     * Pay daily commission
     * it will run every time user logins into system
     * NOTE: to change daily commission just edit PRICE_DAILY_COMMISSION constant;
     */
    public static function payDailyCommission($user) {
        //check if user has got daily commission or not
        $tra = Transaction::where([
            'user_id' => $user->id,
            'type' => self::TYPE_DAILY_COMMISSION,
            ["created_at", ">", Carbon::now()->subday(1)]])->first();

        if ($tra) {
            // commission is gotten
            return;
        }

        $result = self::makeTransaction($user,
            self::TYPE_DAILY_COMMISSION,
            self::PRICE_DAILY_COMMISSION,
            "پورسانت روزانه به ازای ورود");
    }


}
