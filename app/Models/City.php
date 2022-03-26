<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class City extends Model
{
    use HasFactory;


    public function users()
    {
        return $this->hasMany(User::class, 'city_id', 'id');
    }

    public function getActiveStatusAttribute()
    {
        return $this->active == 1 ? 'Active' : 'InActive';
    }
    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'active' => 'boolean',

    ];
}
