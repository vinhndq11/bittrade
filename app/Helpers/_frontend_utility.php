<?php

use App\Helpers\Cart;
use App\Models\District;

function InitLanguage($index = 2)
{
    if(app()->runningInConsole()){
        return config('app.locale');
    }
    $lang = request()->segment($index);
    if($lang === 'api'){
        $lang = request()->segment(2);
    }
    if(!in_array($lang, config('slug.support_languages'))){
        $lang = '/';
    }
    $l = !in_array($lang, config('slug.support_languages')) ? DEFAULT_LANG : $lang;
    app()->setLocale($l);
    return $lang;
}

function changeLanguage($lang = 'vi', $index = false)
{
    $curl = url()->current();
    $root = url()->asset('');

    $kq = str_replace($root, '', $curl);

    $l = substr($kq, 0, 3);
    if ($index)
        return $root . $lang;
    if ($l == 'vi/' || $l == 'en/') {
        $theURL = $lang . '/' . substr($kq, 3);
    } else {
        $theURL = $lang . '/' . $kq;
    }
    return $theURL;
}

function pluralize( $count, $text )
{
    return $count . ( ( $count == 1 ) ? ( " $text" ) : ( " ${text}" ) );
}
function ago( $datetime )
{
    $datetime = date_create($datetime);
    $interval = date_create('now')->diff( $datetime );

    $suffix = ( $interval->invert ? ' trước' : '' );
    if ( $v = $interval->y >= 1 ) return pluralize( $interval->y, 'năm' ) . $suffix;
    if ( $v = $interval->m >= 1 ) return pluralize( $interval->m, 'tháng' ) . $suffix;
    if ( $v = $interval->d >= 1 ) return pluralize( $interval->d, 'ngày' ) . $suffix;
    if ( $v = $interval->h >= 1 ) return pluralize( $interval->h, 'giờ' ) . $suffix;
    if ( $v = $interval->i >= 1 ) return pluralize( $interval->i, 'phút' ) . $suffix;
    return pluralize( $interval->s, 'giây' ) . $suffix;
}

/**
 * @return \App\Models\Member|mixed
 */
function getAuthMember(){
    return auth(GUARD_MEMBER)->user();
}

function getUrlFilter($append = [], $url = null, $excludes = []){
    return ($url ?? url()->current()) . '?' . http_build_query(array_unique(array_merge(request()->except($excludes), $append)));
}

function removeNewLine($str){
    return trim(preg_replace('/\s+/', ' ', $str));
}

function getYoutubeId($link){
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $matches);
    return count($matches) > 0 ? $matches[0] : null;
}
function getMonthString($date, $lang = null){
    $lang = $lang ?? app()->getLocale();
    if($lang == 'vi'){
        return "tháng " . Date2String($date, 'm');
    }
    return Date2String($date, 'F');
}

function strpos_all($haystack, $needle_regex)
{
    preg_match_all('/' . $needle_regex . '/', $haystack, $matches, PREG_OFFSET_CAPTURE);
    return array_map(function ($v) {
        return $v[1];
    }, $matches[0]);
}

function splitNewLineFormat($string, $splitAt = 1){
    $start = strpos_all($string, ' ')[$splitAt - 1] ?? 0;
    return substr_replace($string, '<br>', $start, 1);
}
