<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    const STATUS_CREATED = 0;
    const STATUS_PENDING_CHECKOUT = 1;
    const STATUS_CANCELED = 2;
    const STATUS_CLOSED = 3;

    const userStatusMessages = [
        self::STATUS_CREATED => 'ایجاد شده منتظر پرداخت',
        self::STATUS_PENDING_CHECKOUT => 'پرداخت تایید و تکمیل شده',
        self::STATUS_CLOSED => 'پرداخت تایید و تکمیل شده',
        self::STATUS_CANCELED => 'سفارش لغو شده',
    ];

    public function getStatus() {
        return self::userStatusMessages[$this->status];
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

}
