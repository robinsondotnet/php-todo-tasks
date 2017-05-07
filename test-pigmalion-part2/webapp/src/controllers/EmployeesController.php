<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/6/17
 * Time: 2:07 PM
 */

namespace robindotnet\Controllers;

use FetchLeo\LaravelXml\Converters\CollectionConverter;
use Illuminate\Support\Collection;
use robindotnet\Data\DTO\EmployeeDTO;
use robindotnet\Data\DTO\EmployeeFeedDTO;
use robindotnet\Data\DTO\EmployeeFilterDTO;
use robindotnet\Services\IHumanResourceService;
use robindotnet\Utils\XMLSerializer;
use Sabre\Xml\Service as XmlService;
use SimpleXMLElement;
use Tartan\XmlResponse\XmlResponseServiceProvider;

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
        $dto = new EmployeeFilterDTO($request->getQueryParams());
        $result = $this->hrService->find($dto);
        $body = $response->getBody();
        $array = json_decode($result, true);
        $xml = XMLSerializer::generateValidXmlFromArray($array, 'employees', 'employee');
        $response->withHeader("Content-Type",'application/atom-xml');
        $body->write($xml);
        return $response;
    }

}