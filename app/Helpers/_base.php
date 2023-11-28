<?php

use App\Models\Setting;
use Carbon\Carbon;
use \App\Helpers\Helpers;

function Date2String($inputDate, $formatOut='d/m/Y', $accept_nan = false)
{
    if(!$inputDate && $accept_nan){
        return 'NaN';
    }
    return Carbon::parse($inputDate)->format($formatOut);
}

function genNameFile($extension = 'jpg',$prefix='')
{
    return uniqid($prefix,true).'.'.strtolower($extension);
}

function summary($source_string, $max_len=30)
{
    if(strlen($source_string)<$max_len) return $source_string;
    $html = substr($source_string,0,$max_len);
    return $html.'...';
}


function assetVersion($url) :? string
{
    if(substr($url, 0, 4) === "http"){
        return $url;
    }
    return asset($url).'?v='.env('APP_VERSION','1.1.0');
}

function assetResource($asset = null, $default = null) :? string {
    if(substr($asset ?? '', 0, 4) === "http"){
        return $asset;
    }
    return $asset ? asset($asset) : $default;
}

function getSupportTranslationLocales(){
    return config('translatable.locales');
}

function is_base64($s)
{
    return (bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s);
}

function paginateCollection(Collection $collection, $perPage, $pageName = 'page', $fragment = null)
{
    $currentPage = LengthAwarePaginator::resolveCurrentPage($pageName);
    $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
    parse_str(request()->getQueryString(), $query);
    unset($query[$pageName]);
    $paginator = new LengthAwarePaginator(
        $currentPageItems,
        $collection->count(),
        $perPage,
        $currentPage,
        [
            'pageName' => $pageName,
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'query' => $query,
            'fragment' => $fragment
        ]
    );

    return $paginator;
}

function Form()
{
    return Helpers::getFormInstance();
}

function hasRoleSuperAdminAndEtc($otherRoles = []){
    return getAuthUser()->hasRole(array_push($otherRoles, SUPERADMINISTRATOR)) || getAuthUser()->is_admin == 1;
}

function hasPermissions($permissions = []){
    return getAuthUser()->hasPermission($permissions);
}

function hasPermissionsOrIsSupperAdmin($permissions = []){
    return getAuthUser()->hasPermission($permissions) || getAuthUser()->hasRole(SUPERADMINISTRATOR);
}

function DateRange($start = null, $end = null, $endPlus = 7): CarbonPeriod{
    if(!$start){
        $start = now();
    }
    if(!$end && $endPlus){
        $end = Carbon::parse($start)->addDays($endPlus);
    }
    return CarbonPeriod::create($start, $end);
}

function TimeRange($interval = '1h'): CarbonPeriod {
    $startTime = Setting::content('start_time', "06:00");
    $start = Carbon::createFromTimeString($startTime);

    $endTime = Setting::content('end_time', "23:00");
    $end = Carbon::createFromTimeString($endTime);

    return CarbonPeriod::create($start, $end, $interval);
}


function getLogoAsset(){
    return assetVersion(LOGO_DEFAULT);
}

function addEmptyOption(array $lists, $emptyName = '-----', $emptyValue = null){
    return array_prepend($lists, $emptyName, $emptyValue);
}

function get_class_name($object){
    if(!$object){
        return null;
    }
    $class = is_string($object) ? $object : get_class($object);
    $path = explode('\\', $class);
    return array_pop($path);
}

function r_collect($array)
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $value = r_collect($value);
            $array[$key] = $value;
        }
    }
    return collect($array);
}

function price_format($price){
    return number_format($price);
}

function sqlFileContent($path){
    $fileContent = file_get_contents($path);
    return str_replace('[PREFIX_TABLE]', env('DB_PREFIX'), $fileContent);
}

function generate(){
    return \App\Helpers\GenerateNumber::getInstance();
}
