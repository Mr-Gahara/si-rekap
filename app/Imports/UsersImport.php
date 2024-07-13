<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            if( ($row['0'] != null || $row['1'] != null) && User::where('email',$row['1'])->doesntExist()) {
                User::create([
                    'name' => $row['0'],
                    'email' => $row['1'],
                    'password' => Hash::make($row['0']),
                ]);
            }
        }
    }
}
