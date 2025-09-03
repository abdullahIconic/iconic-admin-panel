<?php

if(!function_exists('logo')){

    function logo()
    {
        // return asset('storage/' . Info::find(1)->logo);        
        return asset('media/images/logo.svg');        
    }
}

if(!function_exists('readingTime')){

    function readingTime( $data = '' )
    {
        $totalWords = str_word_count( strip_tags( $data ) );
        $avgRead = 275;
        $timeToRead = $totalWords / $avgRead;
        return round( $timeToRead, 2 );
    }
}

if(!function_exists('isActiveRoute')){

    function isActiveRoute($nav){
        $currentRoute =  Route::currentRouteName();
        $array = explode('.', $currentRoute);
        return in_array($nav, $array);
    }
}