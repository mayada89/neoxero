<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['first_name','last_name','phone','password','active','role_id','company_id','email'];
    
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
