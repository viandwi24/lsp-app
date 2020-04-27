<?php
if (!function_exists("getUserHome"))
{
    function getUserHome($role = null)
    {
        if ($role == null)
        {
            if (!auth()->check()) return url('/');
            $role = auth()->user()->role;
        }
        return  url()->route($role . '.home');
    }
}