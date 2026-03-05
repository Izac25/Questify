<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'nome' => 'Admin',
            'email' => 'admin@questify.com',
            'senha' => Hash::make('admin123')
        ]);
    }
}