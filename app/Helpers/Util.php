<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

if (!function_exists('message')) {

    function message($value)
    {
        switch($value){
            case 'add':
                return "Stored Successfully &#128513;";
            case 'update':
                return "Updated Successfully &#128515;";
            case 'exception':
                return "Failure, please try again.";
            case 'unauthorized':
                return "You are not authorized.";
            case 'poweredby':
                return 'Powered by: CPB-IT.';
            default:
                return 'No Action Found';
        }
    }
}


function saved_success() {
	return "Stored Successfully &#128513;";
}

function updated_success() {
	return "Updated Successfully &#128515;";
}

function deleted_success() {
	return "Deleted successfully.";
}

function exception() {
	return "Failure, please try again.";
}

function unauthorized() {
	return "You are not authorized.";
}

function powered_by() {
	return 'Powered by: CPB-IT.';
}

if (!function_exists('debug_r')) {

    function debug_r($value)
    {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
        die();
    }
}

if (!function_exists('make_slug')) {

    function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }
}

// Create a youtube link
function youtube_video($str = NULL) {
	$url = explode("=", $str);
	if (isset($url[1]))
		return $url[1];
	else
		return $url[0];
}
