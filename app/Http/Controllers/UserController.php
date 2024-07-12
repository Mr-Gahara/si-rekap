<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        try {
            return Excel::download(new UsersExport, 'users.xlsx');
        } catch (\Exception $e) {
            // Log the error or handle it as per your application's error handling strategy
            return redirect()->back()->withErrors('Error exporting users.');
        }
    }
         
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        $this->validate($request,[
            'file' => 'required'
        ]);
        Excel::import(new UsersImport, request()->file('file'));
        return redirect()->back();
    }
}
