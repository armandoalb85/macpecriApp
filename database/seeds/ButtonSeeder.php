<?php

use Illuminate\Database\Seeder;

class ButtonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('button_records')->insert([
          'startdate' => date('Y-m-d',strtotime('01/01/2010')),
          'status' => 'Inactivo',
          'created_at' => date('Y-m-d',strtotime('01/01/2010')),
          'updated_at' => date('Y-m-d',strtotime('01/01/2010'))
      ]);
    }
}
