<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index3');}
    public function index(){
    return view('Admin.Admin_index');
    }
    public function index2(){
        return 'admin2';
    } public function index3(){
        return 'admin3';
    }
}

