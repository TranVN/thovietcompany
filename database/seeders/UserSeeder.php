<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Mr Huy Lương',
            'email' => 'huy@thoviet.com.vn',
            'password' => Hash::make('Thoviet58568!@#'),
            
        ]);
        DB::table('users')->insert([
            'name' => 'Mr Thông Nguyễn',
            'email' => 'thong@thoviet.com.vn',
            'password' => Hash::make('Thoviet58568!@#'),
            
        ]);
        DB::table('users')->insert([
            'name' => 'Mr Hậu Nguyễn',
            'email' => 'haunguyen@thoviet.com.vn',
            'password' => Hash::make('Thoviet58568!@#'),
            
        ]);
        DB::table('users')->insert([
            'name' => 'Mr Hậu Phạm',
            'email' => 'haupham@thoviet.com.vn',
            'password' => Hash::make('Thoviet58568!@#'),
            
        ]);
        DB::table('users')->insert([
            'name' => 'Mr Thiện Phạm',
            'email' => 'thienpham@thoviet.com.vn',
            'password' => Hash::make('Thoviet58568!@#'),
            
        ]);
        DB::table('users')->insert([
            'name' => 'Ms Như Lương',
            'email' => 'nhuluong@thoviet.com.vn',
            'password' => Hash::make('Thoviet58568!@#'),
            
        ]);
        DB::table('users')->insert([
            'name' => 'Mr Kiệt Trịnh',
            'email' => 'kiettrinh@thoviet.com.vn',
            'password' => Hash::make('Thoviet58568!@#'),
            
        ]);
        DB::table('users')->insert([
            'name' => 'Mr Tùng Phan',
            'email' => 'tungphan@thoviet.com.vn',
            'password' => Hash::make('Thoviet58568!@#'),
            'permission' => 2,
            
        ]);
        DB::table('users')->insert([
            'name' => 'Ms Yến Dương',
            'email' => 'yen@thoviet.com.vn',
            'password' => Hash::make('Thoviet58568!@#'),
            
        ]);
        DB::table('users')->insert([
            'name' => 'Ms Trang Lê',
            'email' => 'trangle@thoviet.com.vn',
            'password' => Hash::make('Thoviet58568!@#'),
            
        ]);
        DB::table('users')->insert([
            'name' => 'Trần',
            'email' => 'tranmanh@thoviet.com.vn',
            'password' => Hash::make('Thoviet58568!@#'),
            'permission' => 2,
        ]);
    }
}
