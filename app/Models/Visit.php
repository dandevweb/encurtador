<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\IpDetails;

class Visit extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function counterVisitsBrazil(): void
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $now = date('Y-m-d H:i:s');
        $ipDetails = new IpDetails($ip);
        $ipDetails->scan();
        $ipBrazil = $ipDetails->get_country() == 'Brazil';
        $existsVisit = $this->where('id', $ip)->first();

        if (!$existsVisit && $ipBrazil) {
            $country = $ipDetails->get_country();
            $state = $ipDetails->get_region();
            $city = $ipDetails->get_city();
            $visit = new Visit();
            $visit->ip = $ip;
            $visit->city = $city;
            $visit->state = $state;
            $visit->country = $country;
            $visit->now = $now;
            $visit->save();
        } else if ($existsVisit){
            $existsVisit->ip = $ip;
            $existsVisit->now = $now;
            $existsVisit->save();
        }
    }
}