<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property Member member
 */
class TransactionWithdrawal extends BaseModel
{
    protected $fillable = [
        'payment_type',
        'bank_name',
        'bank_number',
        'bank_account',
        'bank_branch',
        'expired_date',
        'cvv',
        'transaction_id'
    ];

    public $timestamps = false;

    public function transaction()
    {
        return $this->belongsTo(MemberTransaction::class, 'transaction_id');
    }
}
