<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/6/17
 * Time: 5:17 PM
 */

namespace robindotnet\Repositories;


class EmployeeRepository extends BaseRepository implements IEmployeeRepository
{
    protected $table;

    public function __construct(Builder $table)
    {
        $this->table = $table;
    }

    public function get($id) {
        
    }

    public function getAll() {

    }

}