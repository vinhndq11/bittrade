<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property Member member
 * @property string code
 * @property int member_id
 * @property string point_type
 * @property string point_type_label
 * @property string transaction_type
 * @property string transaction_type_label
 * @property string transaction_status
 * @property string transaction_status_label
 * @property double value
 * @property double open_price
 * @property double close_price
 * @property string bet_condition
 * @property double bet_value
 * @property int bet_id
 * @property string note
 * @property TransactionWithdrawal withdrawal
 * @property int commission_member_id
 * @property Member commission_ref
 * @property int commission_transaction_id
 * @property double commission_percent
 * @property string commission_type
 * @property int commission_level
 * @property string commission_ref_name
 * @property string payment_type
 * @method static challenge($start, $end, $type, $limit = 50)
 */
class MemberTransaction extends BaseModel
{
    protected $fillable = [
        'code',
        'member_id',
        'point_type',
        'transaction_type',
        'transaction_status',
        'value',
        'bet_condition',
        'bet_value',
        'bet_id',
        'note',
        'open_price',
        'close_price',
        'commission_member_id',
        'commission_transaction_id',
        'commission_percent',
        'commission_type',
        'commission_level',
        'payment_type'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $code = (int) round(now()->format('Uu') / pow(10, 6 - 3));
            $model->code = strtoupper(substr($model->transaction_type, 0, 1)) . $code;
        });
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function commission_ref()
    {
        return $this->belongsTo(Member::class, 'commission_member_id');
    }

    public function withdrawal()
    {
        return $this->hasOne(TransactionWithdrawal::class, 'transaction_id');
    }

    public function scopeBalance(Builder $query)
    {
        $balance = $query->where(function ($query){
            $query->where('transaction_status', TRANSACTION_STATUS_FINISH)
                ->orWhere(function ($query){
                    $query->where('transaction_status', TRANSACTION_STATUS_PENDING)
                        ->where('value', '<', 0);
                });
        })->sum('value');
        return floor($balance);
    }

    public function scopeChallenge(Builder $query, $start, $end, $type, $limit = 50)
    {
        return $query->where('transaction_status', TRANSACTION_STATUS_FINISH)
            ->where('point_type', POINT_TYPE_REAL)
            ->whereBetween('created_at', [$start->startOfDay(), $end->endOfDay()])
            ->when($type == CHALLENGE_TYPE_AGENCY, function ($query){
                $query->where('transaction_type', TRANSACTION_TYPE_REF)
                    ->where('commission_type', COMMISSION_TYPE_TRADE)
                    ->selectRaw("member_id, sum(value) as sum");
            }, function ($query){
                $query->where('transaction_type', TRANSACTION_TYPE_BET)
                    ->selectRaw("member_id, sum(bet_value) as sum");
            })
            ->groupBy(['member_id'])
            ->havingRaw('sum >= 1')
            ->orderByDesc('sum')
            ->limit($limit);
    }

    public function getPointTypeLabelAttribute()
    {
        return trans("frontend.point_type.{$this->point_type}");
    }

    public function getTransactionTypeLabelAttribute()
    {
        $text = trans("frontend.transaction_type.{$this->transaction_type}");
        if($this->transaction_type == TRANSACTION_TYPE_REF){
            $text = $text . ' ' . trans("frontend.commission_type.{$this->commission_type}") . " F{$this->commission_level}";
        }
        if($this->transaction_type == TRANSACTION_TYPE_RECHARGE){
            $type = strtoupper($this->payment_type ?? PAYMENT_TYPE_BANK);
            $text = $text . " ({$type})";
        }
        return $text;
    }

    public function getTransactionStatusLabelAttribute()
    {
        return trans("frontend.transaction_status.{$this->transaction_status}");
    }

    public function getValueAttribute($value)
    {
        return floor($value);
    }

    public function getCommissionRefNameAttribute()
    {
        return optional($this->commission_ref)->display_name ?? '';
    }

    public function responseModel()
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'point_type' => $this->point_type,
            'point_type_label' => $this->point_type_label,
            'transaction_type' => $this->transaction_type,
            'transaction_type_label' => $this->transaction_type_label,
            'transaction_status' => $this->transaction_status,
            'transaction_status_label' => $this->transaction_status_label,
            'value' => $this->value,
            'created_at' => Date2String($this->created_at, MYSQL_FORMAT_DATE),
            'withdrawal' => $this->withdrawal,
            'bet_condition' => $this->bet_condition,
            'bet_value' => $this->bet_value,
            'commission_ref_name' => $this->commission_ref_name,
            'commission_level' => $this->commission_level,
            'payment_type' => $this->payment_type,
        ];
    }
}
