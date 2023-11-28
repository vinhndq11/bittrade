<?php


namespace App\Traits;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * show off @method
 *
 * @method static Builder active()
 * @method Builder activeAndSort($sorts = ['position' => 'asc'])
 * @method Builder withAndWhereHas($relation, $constraint)
 * @method Builder where($column, $operate = null, $condition = null)
 * @method Builder orderByBelongToTable($relationship, $columnOnBelongToTable, $direction = 'asc')
 * @method Builder selectTranslation()
 * @method static Builder|mixed|self find(int $id)
 * @method static static create($input)
 */
trait ModelTrait
{
    protected $images = [
        'avatar' => 'upload/images/avatar', // attribute_name => folder_name
        'image' => 'upload/images/image',
        'thumbnail' => 'upload/images/thumbnail',
        'logo' => 'upload/images/logo',
        'icon' => 'upload/images/icon',
    ];

    public static $includes = [];

    public function scopeWithAndWhereHas(Builder $query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where("{$this->getTable()}.is_active", 1);
    }

    public function scopeActiveAndSort(Builder $query, $sorts = ['position' => 'asc'])
    {
        $query = $query->where("{$this->getTable()}.is_active", 1);
        foreach ($sorts as $column=>$direction) {
            $query = $query->orderBy("{$this->getTable()}.{$column}", $direction);
        }
        return $query;
    }

    public function setAttribute($property, $value)
    {
        switch ($property) {
            case 'password':
                {
                    if (!empty($value)) {
                        $this->attributes['password'] = Hash::make($value);
                    }
                }
                return null;
            case 'birthday':
                {
                    $this->attributes['birthday'] = $value ? Carbon::createFromFormat(BIRTHDAY_FORMAT_DATE, $value) : null;
                }
                return null;
        }
        return parent::setAttribute($property, $value);
    }

    private function deleteOldImageBase($key)
    {
        try {
            $filePath = public_path($this->attributes[$key]);
            if ($this->attributes[$key] && is_file($filePath)) {
                unlink($filePath);
            }
        } catch (\Exception $exception) {
        }
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (in_array('password', $model->fillable) && !$model->password) {
                $model->password = $model->email;
            }
        });
    }

    public function hasAttribute($attr)
    {
        return in_array($attr, $this->fillable);
    }

    public function getImagesColumn()
    {
        return $this->images;
    }

    public function scopeOrderByBelongToTable(Builder $query, $relationship, $columnOnBelongToTable, $direction = 'asc')
    {
        $relation = $this->{$relationship}();
        $related = $relation->getRelated();
        $table = $related->getTable();
        $foreignKey = $relation->getForeignKey();
        return $query->join($table, $related->getQualifiedKeyName(),'=',"{$this->getTable()}.{$foreignKey}" )
            ->orderBy("{$table}.{$columnOnBelongToTable}", $direction);
    }

    public function scopeOrderByHasManyTable(Builder $query, $relationship, $columnOnHasManyToTable, $direction = 'asc', $columnChild = null, $directionChild = null, $rawData = null)
    {
        $db_prefix = env('DB_PREFIX');
        $relation = $this->{$relationship}();
        $related = $relation->getRelated();
        $table = $related->getTable();
        $foreignKey = $relation->getForeignKeyName();
        if(!$columnChild){
            $columnChild = $columnOnHasManyToTable;
        }
        if(!$directionChild){
            $directionChild = $direction;
        }
        return $query->select(
                        "{$this->getTable()}.*",
                                DB::raw("(select pp.{$columnOnHasManyToTable} from {$db_prefix}{$this->getTable()} p left join {$db_prefix}{$table}  pp on p.{$this->primaryKey} = pp.{$foreignKey} where {$db_prefix}{$this->getTable()}.id = p.id order by pp.{$columnChild} {$directionChild} limit 1) as pp_{$columnOnHasManyToTable}")
                            )
            ->orderBy("pp_{$columnOnHasManyToTable}", $direction);
    }

    public function scopeDdSql(Builder $query)
    {
        dd($query->toSql());
    }

    public static function getTableName()
    {
        return (new static())->getTable();
    }

    /**
     * @param Builder|mixed $collection
     * @return mixed
     */
    public static function responseMapping($collection)
    {
        if(is_array($collection)){
            $collection = new Collection($collection);
        }
        if(!($collection instanceof Collection)){
            $collection = $collection->get();
        }
        return $collection
            ->map(function ($item){
                return $item->responseModel();
            });
    }

    public function responseModel()
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    public static function toCode($number)
    {
        return strlen("$number") < 2 ? "0{$number}" : $number;
    }

    public function getCodeAttribute($code)
    {
        return $code ? $this->toCode($code) : $this->toCode($this->id);
    }

    public static function nextCode()
    {
        return self::toCode(optional(self::latest()->first())->id + 1);
    }

    private static $modelStatic = null;
    public static function findStatic($model_id)
    {
        return self::$modelStatic ?? self::$modelStatic = self::find($model_id);
    }

    public function scopeSelectTranslation($query)
    {
        $translationTable = app()->make($this->getTranslationModelName())->getTable();
        $localeKey = $this->getLocaleKey();
        return $query
            ->select($this->getTable().'.*')
            ->leftJoin($translationTable, $translationTable.'.'.$this->getRelationKey(), '=', $this->getTable().'.'.$this->getKeyName())
            ->where($translationTable.'.'.$localeKey, $this->locale());
    }
}
