<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Online extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function usersOnline():void
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        $now = date('Y-m-d H:i:s');
        $itsOnline = $this->where('ip', $ip)->first();

        if (!$itsOnline) {
            $online = new Online();
            $online->ip = $ip;
            $online->updated_at = $now;
            $online->save();
        }

        $lastMinute = date('Y-m-d H:i:s', strtotime('-60 second', strtotime($now)));
        $this->where('updated_at', '<=', $lastMinute)->delete();
    }
}