<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersData = [
            [
                'email' => 'nazwasitiruqayyah@gmail.com',
                'password' => 'nazwa123',
                'name' => 'Nazwa',
            ],
        ];

        foreach ($usersData as $userData) {
            try {
                $this->validateUserData($userData);

                User::create([
                    'email' => $userData['email'],
                    'password' => bcrypt($userData['password']),
                    'name' => $userData['name'],
                ]);
            } catch (\Exception $e) {
                $this->command->error($e->getMessage()); 
            }
        }
    }

    /**
     * Validasi data pengguna sebelum membuatnya.
     *
     * @param array $userData
     * @throws \Exception
     */
    private function validateUserData(array $userData): void
    {
        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Email harus dalam format yang benar.');
        }

        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $userData['password'])) {
            throw new \Exception('Password harus terdiri dari minimal 8 karakter yang terdiri dari huruf dan angka.');
        }
    }
}