<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }
    public function user()
    {
        return User::all(); 
    }
    public function profile(User $user)
    {
        return $user;
    }
}
