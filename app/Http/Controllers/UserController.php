<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * This returns all users collection
     */
    public static function getUsers(){
        return User::all();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboardView()
    {
        return view('account.dashboard')
        ->with('categories', app(CategoryController::class)->index())
        ->with('products', ProductController::index())
        ->with('carts', (new CartController)->index());
    }
}
