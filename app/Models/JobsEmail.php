<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsEmail extends Model
{
    protected $fillable = [
        'queue',
        'payload', 
    ];
}
