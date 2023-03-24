<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UyeController extends Controller
{
    public function uyeler()
    {
        $users=User::orderBy('name')->get();
        return view('uyepages.uyeler',compact('users'));
    }
}
