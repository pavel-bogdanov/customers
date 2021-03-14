<?php

namespace App\Repositories\Interfaces;

/**
 *
 * @author Pavel
 */
interface CountryRepositoryInterface {
    public function add(string $country);
    public function get(string $country);
}
