<?php

if (!function_exists('static_asset')) {

    function static_asset($path = null, $secure = null)
    {
        if (strpos(php_sapi_name(), 'cli') !== false || defined('LARAVEL_START_FROM_PUBLIC')) :
            return app('url')->asset($path, $secure);
        else:
            return app('url')->asset('public/' . $path, $secure);
        endif;
    }
}

if (!function_exists('is_file_exists')) {
    function is_file_exists($item, $storage = 'local')
    {
        if (!blank($item) and !blank($storage)) :
            if ($storage == 'local') :
                if (file_exists('public/' . $item)) :
                    return true;
                endif;
            elseif ($storage == 'aws_s3') :
                if (Storage::disk('s3')->exists($item)) :
                    return true;
                endif;
            elseif ($storage == 'wasabi') :
                if (Storage::disk('wasabi')->exists($item)) :
                    return true;
                endif;
            endif;

        endif;

        return false;
    }
}

if (!function_exists('isDemoServer')) {

    function isDemoServer(): bool
    {
        if (strtolower(\Config::get('app.demo_mode')) == 'yes') {
            return true;
        }
        return false;
    }
}