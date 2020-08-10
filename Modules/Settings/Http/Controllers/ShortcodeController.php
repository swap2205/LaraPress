<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ShortcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('settings::index');
    }

    // Parse the string and return the possible shortcodes
    public static function parseData($str){
        $regEx = '/\[(.*)(.*)\]/i';
        $matches = [];

        preg_match_all($regEx,$str,$matches);
        return $matches[1];
    }
}
