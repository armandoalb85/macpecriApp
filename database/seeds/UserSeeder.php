<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'name' => 'Adira',
          'email' => 'adira@gmail.com',
          'password' => md5('Macpecri123*'),
          'username' => 'adi411'
      ]);

      DB::table('users')->insert([
          'name' => 'Kimberlyn',
          'email' => 'kimi@gmail.com',
          'password' => md5('Macpecri123*'),
          'username' => 'kimicaral'
      ]);

      DB::table('users')->insert([
          'name' => 'juan',
          'email' => 'f_juan@gmail.com',
          'password' => md5('Macpecri123*'),
          'username' => 'juancho'
      ]);

      DB::table('users')->insert([
          'name' => 'Gabriel',
          'email' => 'gabo_a@gmail.com',
          'password' => md5('Macpecri123*'),
          'username' => 'gabito'
      ]);

      DB::table('users')->insert([
          'name' => 'Gabriela',
          'email' => 'sarla@gmail.com',
          'password' => md5('Macpecri123*'),
          'username' => 'sarita'
      ]);

    }
}
