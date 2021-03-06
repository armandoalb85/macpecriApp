<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(SubscriberSeeder::class);
        $this->call(SubscriberHistorySeeder::class);
        $this->call(SubscriptionTypeSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(PaymentMethodRecordSeeder::class);
        $this->call(PaymentAccountStatementSeeder::class);
        $this->call(NewsletterSeeder::class);
        $this->call(SubscriberSubscriptionTypeSeeder::class);
        $this->call(AfiliationSeeder::class);
        $this->call(SubscribeNowSeeder::class);
        $this->call(ButtonSeeder::class);
    }
}
