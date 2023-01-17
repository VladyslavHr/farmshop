<?php

if (!function_exists('bar')) {
    function bar($message)
    {
        return \Debugbar::info($message);
    }
}



