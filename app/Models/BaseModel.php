<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 * @method static Builder|BaseModel|mixed active()
 * @method static Builder|BaseModel activeAndSort($sorts = ['position' => 'asc'])
 * @method static Builder withAndWhereHas($relation, $constraint)
 * @method static Builder withTranslation()
 * @method static Builder|BaseModel with($relations)
 * @method static Builder|BaseModel whereTranslation($key, $value, $locale = null)
 * @method static Builder whereTranslationLike($key, $value, $locale = null)
 *
 * @property int id
 * @property string name
 * @property string slug
 * @property string address
 * @property string phone
 * @property string lang
 * @property string last_login
 * @property string $description
 * @property int $position
 * @property int $is_active
 * @property string $image
 * @property string $avatar
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property BaseModel|mixed $pivot
 * @property array static $includes;
 * @property string translations;
 */
class BaseModel extends Model
{
    use ModelTrait;

    protected $dates = ['deleted_at'];
    public $translatedAttributes = [];
}
