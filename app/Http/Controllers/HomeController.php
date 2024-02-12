<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    
    public function index()
    {
        $role = Auth::user()->role;
        $checkrole = explode(',', $role);
        if (in_array('user', $checkrole)) {
            return redirect('users/');
        } else if (in_array('admin', $checkrole)) {
            return redirect('admin/');
        }

    }
}
