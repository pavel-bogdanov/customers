<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Country extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'iso_2', 
        'iso_3', 
        'capital', 
        'area', 
        'flag', 
        'currency_code', 
        'currency_symbol', 
    ];
    
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
