<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Account;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function run()
    {
         Account::factory()->create([
            'id'=> 'account-00000000-0000-0000-0000-000000000001',
            'account_number'=> '000000000001',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@yopmail.com',
            'password' => app('hash')->make('12345678'),
            'birthday' => '1970-01-01',
            'gender' => 'male',
            'phone' => '+33602010302',
            'locale' => 'fr',
            'role' => 'SUPER_ADMIN',
            'role_id' => 'admin-00000000-0000-0000-0000-000000000001',
            'keep_logging' => '1',
         ]);

        Account::factory()->create([
            'id'=> 'account-00000000-0000-0000-0000-000000000002',
            'account_number'=> '000000000002',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@yopmail.com',
            'password' => app('hash')->make('12345678'),
            'birthday' => '1970-01-01',
            'gender' => 'male',
            'phone' => '+33602010301',
            'locale' => 'fr',
            'role' => 'USER',
            'role_id' => 'user-00000000-0000-0000-0000-000000000001',
            'keep_logging' => '1',
        ]);

        Account::factory()->create([
            'id'=> 'account-00000000-0000-0000-0000-000000000003',
            'account_number'=> '000000000003',
            'first_name' => 'Store',
            'last_name' => 'Owner1',
            'email' => 'storeowner@yopmail.com',
            'password' => app('hash')->make('12345678'),
            'birthday' => '1970-01-01',
            'gender' => 'male',
            'phone' => '+33602010307',
            'locale' => 'fr',
            'role' => 'STORE_OWNER',
            'role_id' => 'store-00000000-0000-0000-0000-000000000001',
            'keep_logging' => '1',
        ]);

        Account::factory()->create([
            'id'=> 'account-00000000-0000-0000-0000-000000000004',
            'account_number'=> '000000000004',
            'first_name' => 'Store',
            'last_name' => 'Owner2',
            'email' => 'storeowner2@yopmail.com',
            'password' => app('hash')->make('12345678'),
            'birthday' => '1970-01-01',
            'gender' => 'male',
            'phone' => '+33602010308',
            'locale' => 'fr',
            'role' => 'STORE_OWNER',
            'role_id' => 'store-00000000-0000-0000-0000-000000000002',
            'keep_logging' => '1',
        ]);

        Account::factory()->create([
            'id'=> 'account-00000000-0000-0000-0000-000000000005',
            'account_number'=> '000000000005',
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'janedoe@yopmail.com',
            'password' => app('hash')->make('12345678'),
            'birthday' => '1970-01-01',
            'gender' => 'female',
            'phone' => '+33602010341',
            'locale' => 'fr',
            'role' => 'USER',
            'role_id' => 'user-00000000-0000-0000-0000-000000000002',
            'keep_logging' => '1',
        ]);

        Account::factory()->create([
            'id'=> 'account-00000000-0000-0000-0000-000000000006',
            'account_number'=> '000000000006',
            'first_name' => 'Employee',
            'last_name' => 'Stock',
            'email' => 'employeestock@yopmail.com',
            'password' => app('hash')->make('12345678'),
            'birthday' => '1970-01-01',
            'gender' => 'female',
            'phone' => '+33602010348',
            'locale' => 'fr',
            'role' => 'EMPLOYEE_STOCK',
            'role_id' => 'employee-00000000-0000-0000-0000-000000000001',
            'keep_logging' => '1',
        ]);
    }
}
