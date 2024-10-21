<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Membuat role admin dan scanner officer jika belum ada
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'scanner officer']);

        // Membuat user admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@admin.com'),
        ]);
        $admin->assignRole('admin');

        // Membuat user scanner officers
        $scannerUsers = [
            'scan1@scan.com',
            'scan2@scan.com',
            'scan3@scan.com',
            'scan4@scan.com',
        ];

        foreach ($scannerUsers as $email) {
            $scanner = User::create([
                'name' => 'Scanner Officer',
                'email' => $email,
                'password' => bcrypt($email),
            ]);
            $scanner->assignRole('scanner officer');
        }
    }
}
