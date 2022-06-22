<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    use HasFactory;
    protected $table = 'translate';

    public function urlExists(string $url)
    {
        return $this->where('new_link', $url)->first();
    }
}