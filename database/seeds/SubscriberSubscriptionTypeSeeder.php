<?php

use Illuminate\Database\Seeder;

class SubscriberSubscriptionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('13/10/2019')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'subscriber_id' => 1,
            'subscription_id' => 1
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('09/12/2019')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'subscriber_id' => 2,
            'subscription_id' => 3
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('03/09/2018')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'subscriber_id' => 3,
            'subscription_id' => 2
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('02/10/2019')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'subscriber_id' => 4,
            'subscription_id' => 2
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('06/10/2019')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'subscriber_id' => 5,
            'subscription_id' => 2
        ]);
    }
}
