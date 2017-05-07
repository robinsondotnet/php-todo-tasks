<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/6/17
 * Time: 5:29 PM
 */

namespace robindotnet\Services;


use robindotnet\Data\DTO\EmployeeFilterDTO;

interface IHumanResourceService
{
    public function getEmployees();

    public function getEmployee($id);

    public function find(EmployeeFilterDTO $filter);

}