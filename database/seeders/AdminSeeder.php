<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private function AdminData(){
        return [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => Carbon::now()
        ];
    }

    public function run()
    {
        $users = [
            ['name' => 'user1', 'email' => 'user1@admin.com', 'password' => Hash::make('12345678'), 'email_verified_at' => Carbon::now()],
            ['name' => 'user2', 'email' => 'user2@admin.com', 'password' => Hash::make('12345678'), 'email_verified_at' => Carbon::now()]
        ];

        //create admin
        User::create($this->AdminData());

        //create users
        foreach ($users as $user){
            User::create($user);
        }
    }

}


