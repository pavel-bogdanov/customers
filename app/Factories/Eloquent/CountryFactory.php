<?php

namespace App\Factories\Eloquent;

use App\Factories\Interfaces\CountryFactoryInterface;
use App\Models\Country;

/**
 * Description of CountryFactory
 *
 * @author Pavel
 */
class CountryFactory implements CountryFactoryInterface {
    
    public function create($countryData) 
    {
        $country = new Country();
        $country->name = $countryData['name'];
        $country->iso_2 = $countryData['iso_2'];
        $country->iso_3 = $countryData['iso_3'];
        $country->capital = $countryData['capital'];
        $country->area = $countryData['area'] ?? '';
        $country->flag = $countryData['flag'] ?? '';
        $country->currency_code = $countryData['currency_code'] ?? '';
        $country->currency_symbol = $countryData['currency_symbol'] ?? '';
        
        $country->save();
        
        return $country;
    }

}
