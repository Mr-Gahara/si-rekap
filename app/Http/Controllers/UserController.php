<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
  
        return view('users', compact('users'));
    }
          
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        // return Excel::download(new UsersExport, 'users.xlsx');
    }
         
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        
    }
}
