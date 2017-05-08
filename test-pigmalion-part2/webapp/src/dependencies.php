<?php
// DIC configuration

use robindotnet\Controllers\EmployeesController;
use robindotnet\Models\Employee;
use robindotnet\Repositories\EmployeeRepository;
use robindotnet\Services\HumanResourceService;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Solo lo usaremos cuando necesitemos escribir información
//$container['db'] = function ($container) {
//    $capsule = new \Illuminate\Database\Capsule\Manager;
//    $capsule->addConnection($container['settings']['db']);
//
//    $capsule->setAsGlobal();
//    $capsule->bootEloquent();
//
//    return $capsule;
//};

$container[EmployeesController::class] = function ($c) {
    $service = $c->get(HumanResourceService::class);
  return new EmployeesController($service);
};

$container[HumanResourceService::class] = function ($c) {
    $repository = $c->get(EmployeeRepository::class);
  return new HumanResourceService($repository);
};

$container['employeesJSON'] = function ($c) {
    // todo: mejorar esto
    $path = $c->get('settings')['employees_json'];
    $employees = json_decode(file_get_contents($path));
    return collect($employees);
};

$container[EmployeeRepository::class] = function ($c) {
//    $table = $c->get('db')->table('employees');
    $employees = $c->get('employeesJSON');
    return new EmployeeRepository($employees);
};

