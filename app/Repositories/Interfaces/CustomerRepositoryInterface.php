<?php

namespace App\Repositories\Interfaces;

/**
 *
 * @author Pavel
 */
interface CustomerRepositoryInterface {
    public function add(array $data);
    public function get(int $id);
    public function getAll(array $filters);
}
