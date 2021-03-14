<?php

namespace App\Services\Interfaces;

/**
 *
 * @author Pavel
 */
interface CountryServiceInterface {
    public function getCountryData(string $iso2) : array;
}
