<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    //
    protected $fillable = [
        'first_name',
        'last_name',
        'willing_to_relocate',
    ];

    protected $casts = [
        'willing_to_relocate' => 'boolean',
    ];

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Languages::class, 'employee_language');
    }

    public function getFirstNameAttribute($value): void
    {
        $this->attributes['first_name'] = ucfirst(strtolower($value));
    }
    
    public function getLastNameAttribute($value): void
    {
        $this->attributes['last_name'] = ucfirst(strtolower($value));
    }
}
