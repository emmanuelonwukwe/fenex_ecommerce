<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboardView(){
        return view("admin.dashboard", ["users" => UserController::getUsers()]);
    }
}
