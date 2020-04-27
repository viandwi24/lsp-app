<?php
if (!function_exists("assets"))
{
    function assets($url)
    {
        return asset('assets/' . $url);
    }
}