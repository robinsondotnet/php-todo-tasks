<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/6/17
 * Time: 7:06 PM
 */

namespace robindotnet\Data\DTO;


class EmployeeFilterDTO
{
    public function __construct(array $input)
    {
        $properties = get_object_vars($this);
        $self = $this;
        array_filter($properties, function($item) use ($self, $input) {
            if(isset($input->{$item}))
                $self->{$item} = $input->{$item};
        });
    }

    private $minSalary;

    private $maxSalary;

    /**
     * @return mixed
     */
    public function getMinSalary()
    {
        return $this->minSalary;
    }

    /**
     * @return mixed
     */
    public function getMaxSalary()
    {
        return $this->maxSalary;
    }

}