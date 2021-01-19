<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:User']);
    }
    public function setting()
    {
        return view('frontend.pages.setting');
    }
}
