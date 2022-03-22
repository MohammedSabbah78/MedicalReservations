<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class City extends Model
{
    use HasFactory;


    public function users (){
        return $this->hasMany(User::class,'city_id','id');
    }

    public function getActiveStatusAttribute(){
            return $this->active ==1 ? 'Active' : 'InActive';

    }
}
