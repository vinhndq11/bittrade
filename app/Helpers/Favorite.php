<?php
/**
 * Filename: Favorite.php
 * Date: 2019-11-04
 * Time: 16:13
 */

namespace App\Helpers;


use App\Models\BaseModel;

/**
 * @property BaseModel mainModel
 */
class Favorite
{
    private static $instance = null;
    private static $FAVORITE_SESSION_NAME = 'FAVORITE_SESSION_NAME';
    public static function getInstance()
    {
        return self::$instance ?? (self::$instance = new self());
    }

    private $mainModel = null;
    private $promotionModel = null;
    public function setModel($model)
    {
        $this->mainModel = $model;
        return $this;
    }

    public function __construct(){}

    public function getItemsIds(): array
    {
        return session(self::$FAVORITE_SESSION_NAME, []);
    }

    public function getItemsEloquent()
    {
        $arrayIds = $this->getItemsIds();
        return $this->mainModel->whereIn('id', $arrayIds);
    }

    public function inFavoriteList(int $itemId)
    {
        $arrayIds = $this->getItemsIds();
        return in_array($itemId, $arrayIds);
    }

    public function getItems()
    {
        return $this->getItemsEloquent()->get();
    }

    public function addItem(int $itemId)
    {
        $arrayIds = $this->getItemsIds();
        if($this->inFavoriteList($itemId)){
            return $this;
        }
        array_push($arrayIds, $itemId);
        session([self::$FAVORITE_SESSION_NAME => $arrayIds]);
        return $this;
    }

    public function destroy()
    {
        session()->forget(self::$FAVORITE_SESSION_NAME);
    }

    public function clear()
    {
        $this->destroy();
    }

    public function removeItem(int $itemId)
    {
        $arrayIds = $this->getItemsIds();
        if (($key = array_search($itemId, $arrayIds)) !== false) {
            unset($arrayIds[$key]);
        }
        session([self::$FAVORITE_SESSION_NAME => $arrayIds]);
        return $this;
    }
}
