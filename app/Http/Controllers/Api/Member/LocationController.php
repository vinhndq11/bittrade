<?php

namespace App\Http\Controllers\Api\Member;


use App\Models\District;
use App\Models\Province;
use App\Models\Ward;

class LocationController extends BaseController
{
    public function getProvince()
    {
        $this->mainModel = new Province();
        $this->query = $this->mainModel->whereNotNull('area_id');
        if($area_id = request()->get('area_id')){
            $this->query = $this->query->where('area_id', $area_id);
        }
        return parent::getList();
    }

    public function getDistrict($province_id)
    {
        $this->mainModel = new District();
        $this->query = Province::find($province_id)->districts();
        return parent::getList();
    }

    public function getWard($district_id)
    {
        $this->mainModel = new Ward();
        $this->query = District::find($district_id)->wards();
        return parent::getList();
    }
}
