<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class LangController extends Controller
{
    
    public function change($lang, Request $request){
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function change_test(Request $request){
        dd($request->lang);
        session()->put('lang', $lang);
        return redirect()->back();
    }
}
