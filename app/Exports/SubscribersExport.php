<?php

namespace App\Exports;

use App\Subscriber;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubscribersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      //return Subscriber::all();

      $queryResults = DB::table('subscribers')
            ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
            ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
            ->join('users', 'users.id', '=', 'subscribers.user_id')
            ->whereNull('subscriber_subscription_type.closedate')
            ->select('subscribers.name as name', 'subscribers.lastname as lastname', 'users.username as username', 'users.email as email', 'subscriber_subscription_type.startdate as suscripcion', 'subscription_types.name as type' )
            ->get();
            
      return $queryResults;
    }


}
