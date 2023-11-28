<?php

use App\Helpers\ProductReaderExcelFilter;
use App\Models\User;

function getStatus($stt, $trueText = 'Hoạt động', $falseText = 'Bị khóa')
{
    if($stt)
        return '<i class="fa fa-circle" style="color: green;" title="'.$trueText.'" data-toggle="tooltip" data-placement="top"></i>';
    return '<i class="fa fa-circle" style="color: darkgray;" title="'.$falseText.'" data-toggle="tooltip" data-placement="top"></i>';
}

function getContactContent($title,$content,$max_len = 35)
{
    if(strlen($title)>$max_len)
        return $title;
    return summary($content,$max_len-strlen($title));
}

function convertString($str, $strSymbol = '-',$case = MB_CASE_LOWER)
{
    $str = trim($str);
    if($str == "") return "";
    $str = str_replace('"','',$str);
    $str = str_replace("'",'',$str);
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = mb_convert_case($str,$case,'utf-8');
    $str = preg_replace('/[\W|_]+/',$strSymbol,$str);
    return $str;
}

function urlSeo($source)
{
    return convertString($source,'-',MB_CASE_LOWER).'.html';
}

/**
 * @return User|mixed
 */
function getAuthUser()
{
    return auth()->user() ?? null;
}

function get_view_folder($str){
    preg_match_all('/((?:^|[A-Z])[a-z]+)/',$str,$matches);
    if(count($matches)){
        return strtolower(implode('_',$matches[0]));
    }
    return null;
}

/**
 * @param $class_called
 * @return mixed|\App\Models\BaseModel|\Illuminate\Database\Eloquent\Builder
 */
function getModelFromController($class_called){
    $controller = get_class_name($class_called);
    $model_name = str_replace('Controller', '', $controller);
    $Model = 'App\\Models\\'.$model_name;
    if(class_exists($Model))
        return new $Model();
    return null;
}

function getLanguageList(){
    $locales = config('translatable.locales');
    $result = [];
    foreach ($locales as $locale){
        $result[$locale] = trans('backend.lang', [], $locale);
    }
    return $result;
}

function getCurrentSessionId(){
    $m = $_COOKIE[config('session.cookie')];
    return \Crypt::decryptString($m);
}
