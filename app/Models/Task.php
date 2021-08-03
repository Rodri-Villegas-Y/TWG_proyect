<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = [
        'user_id',
        'description',
        'max_date'
    ];

    protected $appends = [
        'remain',
        ''
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'task_id', 'id')->orderBy('created_at', 'DESC');;
    }

    public function getRemainAttribute()
    {
        $date1 = date_create(date('Y-m-d'));
        $date2 = date_create($this->max_date);
        $diff = date_diff($date1, $date2);

        if ($diff->format('%a') > 1) {
            if ($diff->format('%R') == '+') {
                $days = 'Vence En %a Días';
            }
            else {
                $days = 'Venció Hace %a Días';
            }
        }
        elseif ($diff->format('%a') == 0) {
            $days = 'Hoy Ultimo Día';
        }
        else {
            if ($diff->format('%R') == '+') {
                $days = 'Vence en %a Día';
            }
            else {
                $days = 'Venció Hace %a Día';
            }
        }

        return $diff->format($days);
    }

    public function getStatusAttribute()
    {
        $date1 = date_create(date('Y-m-d'));
        $date2 = date_create($this->max_date);
        $diff = date_diff($date1, $date2);

        if ($diff->format('%R') == '+') {
            return true; // por vencer
        }
        else {
            return false; // vencida
        }
        
    }

    public function getLimitAttribute()
    {
        return date('d-m-Y', strtotime($this->max_date));
    }
}


