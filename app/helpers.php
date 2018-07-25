<?php
if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        return (\Encore\Admin\Facades\Admin::user()->id === 1) ? true : false;
    }
}

if (!function_exists('gravatar_url')) {
    function gravatar_url($email, $size = 48)
    {
        return sprintf("//www.gravatar.com/avatar/%s?s=%s", md5($email), $size);
    }
}

if (!function_exists('gravatar_profile_url')) {

    function gravatar_profile_url($email)
    {
        return sprintf("//www.gravatar.com/%s", md5($email));
    }
}