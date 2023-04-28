<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function aboutUs(){
        return view('about-us');
    }

    public function langChange($lang){
        App::setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
