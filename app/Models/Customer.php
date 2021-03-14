<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class Customer extends Model
{
    use HasFactory;
    
    const ALLOWED_FILTERS = ['name', 'city', 'company_name', 'iso_2'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password', 
        'name', 
        'country_id', 
        'city', 
        'state', 
        'zip', 
        'address', 
        'phone', 
        'company_name',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    
    public function country() {
        return $this->belongsTo(Country::class);
    }
}
