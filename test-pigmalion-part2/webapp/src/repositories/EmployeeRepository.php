<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/6/17
 * Time: 5:17 PM
 */

namespace robindotnet\Repositories;


use Illuminate\Support\Collection;
use robindotnet\Data\DTO\EmployeeDetailDTO;
use robindotnet\Data\DTO\EmployeeDTO;
use robindotnet\Data\DTO\EmployeeFilterDTO;

/**
 * Class EmployeeRepository
 * @package robindotnet\Repositories
 */
class EmployeeRepository implements IEmployeeRepository
{
    /**
     * @var Collection
     */
    protected $employees;

    /**
     * EmployeeRepository constructor.
     * @param Collection $employees
     */
    public function __construct(Collection $employees)
    {
        $this->employees = $employees;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id) {

        $result = $this->employees->where('id', $id)->first();

        if($result) {
            $mapper = new \JsonMapper();
            return $mapper->map($result, new EmployeeDetailDTO());
        }

        return false;
    }


    /**
     * @return Collection
     */
    public function getAll() {
        $mapper = new \JsonMapper();
         return $mapper->mapArray($this->employees, array(), new EmployeeDTO());
    }

    /**
     * @param EmployeeFilterDTO $filter
     * @return Collection
     */
    public function find(EmployeeFilterDTO $filter)
    {
        $result = [];

        if($filter->getMinSalary() && $filter->getMaxSalary()) {
            $result = $this->employees;
//                ->where('salary', '>', $filter->getMinSalary())
//                ->where('salary', '<', $filter->getMaxSalary());
        }

        return $result;
    }
}