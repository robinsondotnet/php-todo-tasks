<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/6/17
 * Time: 2:07 PM
 */

namespace robindotnet\Controllers;

use robindotnet\Data\DTO\EmployeeFilterDTO;
use robindotnet\Services\IHumanResourceService;

/**
 * Class EmployeesController
 * @package robindotnet\Controllers
 */
class EmployeesController
{
    /**
     * @var IHumanResourceService
     */
    protected $hrService;

    /**
     * EmployeesController constructor.
     * @param IHumanResourceService $service
     */
    public function __construct(IHumanResourceService $service) {
        $this->hrService = $service;
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function getAll($request, $response, $args) {
        $result = $this->hrService->getEmployees();
        return $response->withJson($result);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function getById($request, $response, $args) {
        $result = $this->hrService->getEmployee($args['id']);
        return $response->withJson($result);
    }

    public function find($request, $response, $args) {
        $dto = new EmployeeFilterDTO($args);
        $result = $this->hrService->find($dto);
        $body = $response->getBody();
        var_dump($result);
//        $body->write($result);
//        return $response;
    }

}