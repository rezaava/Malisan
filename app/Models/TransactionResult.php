<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionResult extends Model
{

    /*
     * statuses
     */
    const STATUS_SUCCESS = 1;
    const STATUS_INSUFFICIENT_WALLET = 2;
    const STATUS_DATABASE_ERROR = 3;

    private $status;
    private $message;
    private $transaction;

    /*
     * create a transaction result (in Transaction Model)
     */
    public static function create($status, $message = '', $transaction = null) {
        $result = new TransactionResult();
        $result->status = $status;
        $result->message = $message;
        $result->transaction = $transaction;
        return $result;
    }

    /*
     * is transaction was successful
     */
    public function isSuccessful(): bool
    {
        return $this->status == self::STATUS_SUCCESS;
    }

    /*
     * get the message of transaction creating (often used when it's not successful)
     */
    public function getMessage(): string
    {
        if ($this->message != ''){
            return $this->message;
        }

        switch ($this->message) {
            case self::STATUS_SUCCESS: return 'تراکنش با موفقیت ایجاد شد';
            case self::STATUS_INSUFFICIENT_WALLET: return 'موجودی کیف پول کافی نمی باشد.';
            case self::STATUS_DATABASE_ERROR: return 'خطایی فنی رخ داده است';
            default: return '';
        }
    }

    /*
     * get transaction if it's successful
     */
    public function getTransaction(): Transaction
    {
        return $this->transaction;
    }


}
