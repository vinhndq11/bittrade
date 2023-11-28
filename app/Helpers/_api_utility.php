<?php

function responseJSON($data = [], $success = true, $msg = 'SUCCESS', $code = SUCCESS_REQUEST)
{
    return [
        'success' => $success,
        'message' => $msg,
        'code' => $code,
        'data' => $data
    ];
}

function responseJSON_EMPTY_OBJECT($success = true, $msg = 'SUCCESS', $code = SUCCESS_REQUEST)
{
    return [
        'success' => $success,
        'message' => $msg,
        'code' => $code,
        'data' => new ArrayObject()
    ];
}

function responseJSON_NO_DATA($success = true, $msg = 'SUCCESS', $code = SUCCESS_REQUEST)
{
    return [
        'success' => $success,
        'message' => $msg,
        'code' => $code
    ];
}

function ImageObject($name, $file_path)
{
    $image_path = $file_path . '/' . $name;
    $width = $height = 0;
    $link = '';
    if (!empty($name) && file_exists(public_path('/' . $image_path))) {
        $size = getimagesize($image_path);
        $width = $size[0];
        $height = $size[1];
        $link = asset($image_path);
    }
    return [
        'width' => $width,
        'height' => $height,
        'name' => $name,
        'link' => $link
    ];
}


function DateTimeObject($date)
{
    if(!$date)
        return null;
    return Date2String($date, MYSQL_FORMAT_DATE);
}

function getAssetFile($string){
    if(strpos($string, 'http') !== false){
        return $string;
    }
    return asset($string);
}

function newObject(){
    return new ArrayObject();
}

function userToToken($user)
{
    $add['id'] = $user->id;
    $add['now'] = now()->addMinutes(TOKEN_LIFE_TIME)->format(MYSQL_FORMAT_DATE);
    return \App\Helpers\Crypt::encrypt($add);
}

function getUserFromToken($token){
    try {
        $user = \App\Helpers\Crypt::decrypt($token);
        if(\Carbon\Carbon::parse($user['now']) >= now()){
            return optional(\App\Models\MemberDevice::query()->where('login_token', $token)->first())->member;
        }
        return false;
    } catch (\Exception $e) {
        return false;
    }
}

function tokenToCheck($token)
{
    try {
        $user = \App\Helpers\Crypt::decrypt( $token );
        return !(\Carbon\Carbon::parse($user['now']) < \Carbon\Carbon::now());
    } catch (\Exception $e) {
        return false;
    }
}

function getChildren($me, $current_level, $max_level){
    $array[] = [
        'id' => $me->username,
        'name' => $me->display_name,
        'image' => assetResource($me->avatar, asset('img/user.png')),
        'parent' => $me->ref_username,
        'title' => "F{$current_level}" . ($me->user_mode == USER_MODE_UNLIMITED ? " - <b>VIP</b>" : ''),
    ];
    if(++$current_level <= $max_level){
        foreach ($me->children as $child){
            $array = array_merge($array, getChildren($child, $current_level, $max_level));
        }
    }
    return $array;
}

function getPreciseTimestamp(\Carbon\Carbon $date): int{
    return (int) round($date->format('Uu') / pow(10, 6 - 3));
}

function hideUsername($username){
    if(!$username || strlen($username) < 4){
        return $username;
    }
    return substr($username, 0, 3) . '***';
}

function hideMoney($value){
    return strlen($value) > 6 ? '**' . substr(number_format($value), -6, 6) : number_format($value);
}
