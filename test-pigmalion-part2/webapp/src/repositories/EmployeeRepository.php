<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/6/17
 * Time: 5:17 PM
 */

namespace robindotnet\Repositories;


use Illuminate\Support\Collection;
use robindotnet\Data\DTO\EmployeeFilterDTO;

class EmployeeRepository implements IEmployeeRepository
{
    protected $employees;

    public function __construct(Collection $employees)
    {
        $this->employees = $employees;
    }

    public function get($id) {

        foreach ( $this->employees as $employee ) {
            if ( $id == $employee->id ) {
                return $employee;
            }
        }

        return false;
    }


    public function getAll() {
        return $this->employees;
    }

    public function find(EmployeeFilterDTO $filter)
    {
        $result = [];

        if($filter->getMinSalary() && $filter->getMaxSalary()) {
            $result = $this->employees
                ->where('salary', '>', $filter->getMinSalary())
                ->where('salary', '<', $filter->getMaxSalary());
        }

        return $result;
    }
}