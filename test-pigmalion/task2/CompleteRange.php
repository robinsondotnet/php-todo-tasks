<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/5/17
 * Time: 12:53 AM
 */

/**
 * Class CompleteRange
 */
class CompleteRange {
    /**
     * @var IArrayCompleter
     */
    private $_completer;

    /**
     * @param array $input
     * @param IArrayCompleter|null $transformer
     * @return mixed
     */
    public function build(array $input, IArrayCompleter $transformer = null) {
        if (!isset($transformer))
            $this->_completer = new NumberSequenceCompleter();
        else
            $this->_completer = $transformer;

        return $this->_completer->complete($input);
    }

}

/**
 * Interface IArrayCompleter
 */
interface IArrayCompleter {
    /**
     * @param array $input
     * @param IValidator $validator
     * @return mixed
     */
    public function complete(array $input, IValidator $validator);
}

/**
 * Interface IValidator
 */
interface IValidator {
    /**
     * @param $valueToCheck
     * @return mixed
     */
    public function validate($valueToCheck);
}

/**
 * Class PositiveIntegerValidator
 */
class PositiveIntegerValidator implements IValidator {

    /**
     * @var int
     */
    private $_lastNumber = 0;

    /**
     * @param $valueToCheck
     * @return mixed|void
     * @throws Exception
     */
    public function validate($valueToCheck)
    {
            $result = is_int($valueToCheck) && $valueToCheck > 0 && $valueToCheck > $this->_lastNumber;

            if(!$result)
                throw new Exception('Por favor ingrese solo valores enteros y positivos');

            $this->_lastNumber = $valueToCheck;
    }
}

/**
 * Class NumberSequenceCompleter
 */
class NumberSequenceCompleter implements IArrayCompleter {

    /**
     * @var array
     */
    private $output = [];
    /**
     * @var array
     */
    private $input = [];
    /**
     * @var
     */
    private $_validator;

    /**
     * @param $number
     * @param $index
     * @param $context
     */
    private function processNumber($number, $index, $context) {
        array_push($context->output, $number);

        $index++;
        $number++;

        while (array_key_exists($index, $context->input) && (($number) < $context->input[$index])){
            array_push($context->output, $number);

            if (!array_key_exists($index, $context->input))
                $index++;

            $number++;
        }
    }

    /**
     * @param array $input
     * @param IValidator|null $validator
     * @return array
     */
    public function complete(array $input, IValidator $validator = null)
    {
        if (!isset($validator))
            $this->_validator = new PositiveIntegerValidator();
        else
            $this->_validator = $validator;

        $this->input = $input;
        $self = $this;

        array_filter($input, function ($value) use ($self) {
           $self->_validator->validate($value);
        });

        array_filter($input, function ($value, $index) use ($self) {
            $self->processNumber($value, $index, $self);
        }, ARRAY_FILTER_USE_BOTH);

        return $this->output;

    }
}


$utils = new CompleteRange();

var_dump($utils->build([12,20,50]));
