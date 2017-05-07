<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/6/17
 * Time: 5:25 PM
 */

namespace robindotnet\Repositories;


use robindotnet\Data\DTO\EmployeeFilterDTO;

interface IEmployeeRepository
{
    public function get($id);

    public function getAll();

    public function find(EmployeeFilterDTO $filter);

}