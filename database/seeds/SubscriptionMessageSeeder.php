<?php

use Illuminate\Database\Seeder;

class SubscriptionMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscription_messages')->insert([
            'type' => 'Beneficio',
            'status' => 'Activo',
            'message' => 'Se especificara que comprende la suscripción.',
            'configmessage_id' => 1
        ]);

        DB::table('subscription_messages')->insert([
            'type' => 'Porque',
            'status' => 'Activo.',
            'message' => 'Indicar las ventajas y beneficios de contar con una suscripción con MACPECRI.',
            'configmessage_id' => 1
        ]);

        DB::table('subscription_messages')->insert([
            'type' => 'Precio',
            'status' => 'Activo',
            'message' => 'Mensaje con precio segun tipo de suscripción, uno para suscripción paga.',
            'configmessage_id' => 1
        ]);

        DB::table('subscription_messages')->insert([
            'type' => 'Precio',
            'status' => 'Activo',
            'message' => 'Mensaje con precio segun tipo de suscripción, uno para suscripcion gratuita.',
            'configmessage_id' => 1
        ]);

        DB::table('subscription_messages')->insert([
            'type' => 'Mas',
            'status' => 'Activo',
            'message' => 'Mensaje A ubicado en la seccion A.',
            'configmessage_id' => 1
        ]);

        DB::table('subscription_messages')->insert([
            'type' => 'Mas',
            'status' => 'Activo',
            'message' => 'Mensaje A ubicado en la seccion B.',
            'configmessage_id' => 1
        ]);

        DB::table('subscription_messages')->insert([
            'type' => 'Mas',
            'status' => 'Activo',
            'message' => 'Mensaje A ubicado en la seccion C.',
            'configmessage_id' => 1
        ]);

    }
}
