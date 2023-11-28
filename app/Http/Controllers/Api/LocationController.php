<?php

namespace App\Http\Controllers\Api;


use App\Models\District;
use App\Models\City;
use App\Models\Ward;
use Illuminate\Routing\Controller as BaseController;

class LocationController extends BaseController
{
    public function getDistrict($province_id)
    {
        if(!$province_id){
            return responseJSON();
        }
        $query = City::find($province_id)->districts();
        return responseJSON(District::responseMapping($query));
    }

    public function getWard($district_id)
    {
        if(!$district_id){
            return responseJSON();
        }
        $query = District::find($district_id)->wards();
        return responseJSON(Ward::responseMapping($query));
    }
}
