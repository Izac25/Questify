<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instrutor;
use Illuminate\Support\Facades\Hash;

class InstrutorSeeder extends Seeder
{
    public function run()
    {
        Instrutor::create([
            'nome' => 'Professor Admin',
            'email' => 'professor@gmail.com',
            'senha' => Hash::make('123456')
        ]);
    }
}