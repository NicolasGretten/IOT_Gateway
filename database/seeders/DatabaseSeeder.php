<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
<<<<<<< HEAD
use App\Models\Account;
use Illuminate\Contracts\Container\BindingResolutionException;
=======
>>>>>>> template/master
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
<<<<<<< HEAD
     * @throws BindingResolutionException
     */
    public function run()
    {
         Account::factory()->create([
            'id'=> '00000000-0000-0000-000000000000',
            'accountNumber'=> 'MD545698872',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@doe.com',
            'password' => app('hash')->make('12345678'),
            'birthday' => '1970-01-01',
            'gender' => 'male',
            'phone' => '33602010302',
            'locale' => 'fr-fr',
            'keepLogging' => '1',
         ]);
=======
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
>>>>>>> template/master
    }
}
