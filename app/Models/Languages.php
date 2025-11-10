<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    //
    protected $fillable = [
        'lanuage_name',
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_language');
    }
}
