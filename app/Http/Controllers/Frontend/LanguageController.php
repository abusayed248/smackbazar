<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function banglaLang()
    {
        session()->get('lang');
        session()->flush();
        session()->put('lang', 'bangla');
        return redirect()->back();
    }

    public function englishLang()
    {
        session()->get('lang');
        session()->flush();
        session()->put('lang', 'eng');
        return redirect()->back();
    }
}
