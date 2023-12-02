<?php

if (!function_exists('isUserAdmin')) {
    function isUserAdmin()
    {
        if(auth()->user()->role_id == ADMIN_ROLE_ID) {
            return true;
        }
        return false;
    }
}

if (!function_exists('userName')) {
    function userName()
    {
        return auth()->user()->name;
    }
}

if (!function_exists('userRole')) {
    function userRole()
    {
        if(auth()->user()->role_id == ADMIN_ROLE_ID) {
            return 'Admin';
        }
        return 'Warehouse manager';
    }
}

?>