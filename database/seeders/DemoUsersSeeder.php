<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUsersSeeder extends Seeder {
  public function run(): void {
    User::firstOrCreate(
      ['email' => 'admin@gamevault.test'],
      ['name'=>'Admin','password'=>Hash::make('password'),'role'=>'admin']
    );
    User::firstOrCreate(
      ['email' => 'user@gamevault.test'],
      ['name'=>'User','password'=>Hash::make('password'),'role'=>'user']
    );
  }
}

