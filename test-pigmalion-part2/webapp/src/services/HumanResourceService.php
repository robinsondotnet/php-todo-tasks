<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/6/17
 * Time: 4:30 PM
 */

namespace robindotnet\Services;


use robindotnet\Repositories\IEmployeeRepository;

/**
 * Class HumanResourceService
 * @package robindotnet\Services
 */
class HumanResourceService implements IHumanResourceService
{
    /**
     * @var IEmployeeRepository
     */
    protected $repository;

    /**
     * HumanResourceService constructor.
     * @param IEmployeeRepository $repository
     */
    public function __construct(IEmployeeRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @return mixed
     * @throws \Exception
     */
    public function getEmployees()
    {
        try {
            return $this->repository->getAll();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}