<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class col extends Seeder
{
    public function run(): void
    {
        User::create([
            "first_name" => "abd",
            "last_name" => "Sy",
            "phone"=>"0993377888",
            "password"=>bcrypt("123456789"),
            "status"=>"admin",
            "image"=>""
        ]);

    }
}
