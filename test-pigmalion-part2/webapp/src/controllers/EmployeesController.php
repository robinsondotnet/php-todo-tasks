<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/6/17
 * Time: 2:07 PM
 */

namespace robindotnet\Controllers;

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
        return $response;
    }

}