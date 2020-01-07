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
          'password' => md5('Macpecri123#'),
          'username' => 'adi411',
          'created_at' => date('Y-m-d',strtotime('09/15/2019')),
          'updated_at' => date('Y-m-d',strtotime('09/15/2019'))
      ]);

      DB::table('users')->insert([
          'name' => 'Kimberlyn',
          'email' => 'kimi@gmail.com',
          'password' => md5('Macpecri123#'),
          'username' => 'kimicaral',
          'created_at' => date('Y-m-d',strtotime('09/03/2019')),
          'updated_at' => date('Y-m-d',strtotime('09/03/2019'))
      ]);

      DB::table('users')->insert([
          'name' => 'juan',
          'email' => 'f_juan@gmail.com',
          'password' => md5('Macpecri123#'),
          'username' => 'juancho',
          'created_at' => date('Y-m-d',strtotime('09/10/2019')),
          'updated_at' => date('Y-m-d',strtotime('09/10/2019'))
      ]);

      DB::table('users')->insert([
          'name' => 'Gabriel',
          'email' => 'gabo_a@gmail.com',
          'password' => md5('Macpecri123*'),
          'username' => 'gabito',
          'created_at' => date('Y-m-d',strtotime('09/02/2019')),
          'updated_at' => date('Y-m-d',strtotime('09/02/2019'))
      ]);

      DB::table('users')->insert([
          'name' => 'Gabriela',
          'email' => 'sarla@gmail.com',
          'password' => md5('Macpecri123*'),
          'username' => 'sarita',
          'created_at' => date('Y-m-d',strtotime('09/10/2019')),
          'updated_at' => date('Y-m-d',strtotime('09/10/2019'))
      ]);

    }
}
