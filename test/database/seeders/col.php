<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class col extends Seeder
{
    public function run(): void
    {
        // Store::truncate();
    $stores=[
        "store1",
        "store2",
        "store3"
    ];
        foreach ($stores as $store) {
            Store::create([
                "name" => $store,
                "location"=>"loc"
            ]);
        }

    }
}
