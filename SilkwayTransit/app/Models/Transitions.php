<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transitions extends Model
{

    protected $fillable = ['station1_id', 'station2_id', 'st1deportTime', 'st2arriveTime'];

    use HasFactory;
}
