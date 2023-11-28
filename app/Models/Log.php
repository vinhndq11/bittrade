<?php

namespace App\Models;


/**
 * @property User user
 * @property int user_id
 * @property int model_id
 * @property string model
 * @property string method
 * @property string message
 */

class Log extends BaseModel
{
    protected $fillable = [
        'model',
        'model_id',
        'user_id',
        'method',
        'ip',
        'browser',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getMethodLabelAttribute()
    {
        switch ($this->method) {
            case 'update': return 'Cập nhật';
            case 'store': return 'Tạo mới';
            case 'destroy': return 'Xóa';
            case 'postConfirm': return 'Xác nhận';
            default: return $this->method;
        }
    }

    public function getModelLabelAttribute()
    {
        $transFile = str_singular((new $this->model)->getTableName());
        return trans("$transFile.label");
    }
}
