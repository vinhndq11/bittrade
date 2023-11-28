<?php


namespace App\Helpers;


use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\EloquentDataTable;
use Closure;

/**
 * @method static EloquentDataTable of($source)
 * @property EloquentDataTable builder
 * @property BaseModel mainModel
 */
class Datatable extends DataTables
{
    public $builder;
    private $mainModel;
    private $setActionColumn = false;
    private $rawColumns;

    private $ignoreEdit = false;
    private $ignoreDelete = false;

    private static $instance;

    public function __construct()
    {
        $this->rawColumns = config('datatables.columns.raw');
    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        if(!static::$instance){
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * @param Builder|mixed $query
     * @return $this
     * @throws
     */
    public function initBuilder($query)
    {
        if(!$this->builder){
            if(!$query instanceof Builder && !$query instanceof Collection && !$query instanceof \Illuminate\Support\Collection){
                $query = $query->select('*');
            }
            $this->builder = static::of($query);
        }
        return $this;
    }

    public function setMainModel($model)
    {
        $this->mainModel = $model;
        return $this;
    }

    public function ignoreEdit($set = true)
    {
        $this->ignoreEdit = $set;
        return $this;
    }

    public function ignoreDelete($set = true)
    {
        $this->ignoreDelete = $set;
        return $this;
    }

    /**
     * @param string|array $columns
     * @return $this
     */
    public function addRawColumns($columns)
    {
        if(is_string($columns)){
            array_push($this->rawColumns, $columns);
        }
        if(is_array($columns)){
            $this->rawColumns = array_merge($this->rawColumns, $columns);
        }
        return $this;
    }

    public function getBuilder()
    {
        return $this->builder;
    }

    public function setActionColumn($viewFolder, Closure $closure = null)
    {
        if(!$this->setActionColumn && !$closure){
            $this->builder = $this->builder->addColumn('action', function ($value) use ($viewFolder){
                return view('backend.layout.component.button', [
                    'edit' => !$this->ignoreEdit ? route("admin.{$viewFolder}.edit", $value->id ?? 0) : null,
                    'delete' => !$this->ignoreDelete ? [
                        'url' => route("admin.{$viewFolder}.show", $value->id ?? 0),
                        'text' => $value->name ?? $value->title ?? $value->email ?? $value->id
                    ] : null
                ]);
            });
        }
        if($closure){
            $this->builder = $this->builder->addColumn('action', $closure);
            $this->setActionColumn = true;
        }
        return $this;
    }

    public function setActiveColumn()
    {
        if($this->mainModel && $this->mainModel->hasAttribute('is_active')){
            $this->builder = $this->builder->addColumn('active', function ($value){
                return getStatus($value->is_active);
            });
        }
        return $this;
    }

    public function setImageColumns()
    {
        if($this->mainModel && count($images = $this->mainModel->getImagesColumn())){
            foreach ($images as $key=>$folder){
                if($this->mainModel->hasAttribute($key)){
                    $this->builder = $this->builder->editColumn($key, function ($value) use ($key){
                        return "<img alt='{$value->id}' src='{$value->{$key}}' class='img-thumbnail' style='width: 60px;'>";
                    });
                    array_push($this->rawColumns, $key);
                }
            }
        }
        return $this;
    }

    public function getDatatable()
    {
        return $this->builder->rawColumns($this->rawColumns)->addIndexColumn()->make();
    }
}
