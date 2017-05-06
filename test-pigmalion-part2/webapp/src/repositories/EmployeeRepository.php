<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/6/17
 * Time: 5:17 PM
 */

namespace robindotnet\Repositories;


class EmployeeRepository implements IEmployeeRepository
{
    protected $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    public function get($id) {
        
    }

    public function getAll() {
        return $this->employees;
    }

}