<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    const KEY_CASH_ON_DELIVERY = 'CASH_ON_DELIVERY';
    const KEY_ATM_ONLINE = 'ATM_ONLINE';
    const KEY_IB_ONLINE = 'IB_ONLINE';
    const KEY_ATM_OFFLINE = 'ATM_OFFLINE';
    const KEY_VISA = 'VISA';
    const KEY_PAY_AT_STORE_CASH = 'PAY_AT_STORE_CASH';
    const KEY_PAY_AT_STORE_TRANSFER = 'PAY_AT_STORE_TRANSFER';
    const KEY_PAY_AT_STORE_CREDIT = 'PAY_AT_STORE_CREDIT';
    const KEY_PAY_AT_STORE_MOMO = 'PAY_AT_STORE_MOMO';
    const KEY_ORDER_ONLINE = 'ORDER_ONLINE';
    const KEY_COD = 'COD';
    const FEE_TYPE_PERCENT = 1;
    const FEE_TYPE_PRICE = 2;
    const ACTIVE = 1;
    const DISABLE = 0;

    protected $table = 'payment_methods';

    protected $fillable = ['type', 'name', 'key', 'fee', 'fee_type', 'status'];

    /**
     * Translatable field
     *
     * @var array
     */
    public $translatable = ['name'];
}
