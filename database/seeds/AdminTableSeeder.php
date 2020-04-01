<?php

use Illuminate\Database\Seeder;
use App\models\admin\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Admin::create([
            'name' => "Admin Admin",
            'email' => "admin@admin.com",
            'password' => Hash::make('123456789'),
        ]);
    }
}
