<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/5/17
 * Time: 12:43 AM
 */

class ClearPar {

    /**
     * @var IStringTransformer $_transformer
     */
    private $_transformer;

    /**
     * @param $rawString
     * @param IStringTransformer|null $transformer
     * @return string
     */
    public function build($rawString, IStringTransformer $transformer = null) {
        if (!isset($transformer))
            $_transformer = new PairParentsTransformer();
        else
            $this->_transformer = $transformer;

        return $_transformer->transform($rawString);
    }
}

/**
 * Interface IStringTransformer
 */
interface IStringTransformer {
    /**
     * @param string $input
     * @return string
     */
    public function transform($input);
}

/**
 * Class PairParentsTransformer
 */
class PairParentsTransformer implements IStringTransformer
{

    /**
     * @var string
     */
    private $openChar;

    /**
     * @var string
     */
    private $closeChar;

    /**
     * @var
     */
    private $lastChar;


    /**
     * @var string
     */
    private $output;

    /**
     * PairParentsTransformer constructor.
     * @param string $openChar
     * @param string $closeChar
     */
    public function __construct($openChar = '(', $closeChar = ')')
    {
        $this->openChar = $openChar;
        $this->closeChar = $closeChar;
    }

    /**
     * @param int $index
     * @param bool $isUpperCase
     * @return string
     */
    private function getNextChar($index, $isUpperCase = false)
    {
        $count = count($this->_alphabet) - 1;

        $truncate = $index >= $count;
        $incrementCount = $truncate ? $count * -1 : 1;

        $result = $this->_alphabet[$index + $incrementCount];

        return $isUpperCase ? strtoupper($result) : $result;
    }

    /**
     * @param string $char
     */
    private function processChar($char)
    {
        if (!isset($this->lastChar) && $char == $this->openChar) {
            $this->output .= $this->openChar;
            $this->lastChar = $this->openChar;
        } elseif ($this->lastChar == $this->openChar && $char == $this->closeChar) {
            $this->output .= $this->closeChar;
            $this->lastChar = $this->closeChar;
        } elseif ($this->lastChar == $this->closeChar && $char == $this->openChar) {
            $this->output .= $this->openChar;
            $this->lastChar = $this->openChar;
        }
    }

    /**
     * @param string $input
     * @return mixed
     */
    public function transform($input)
    {
        $self = $this;
        $result = str_split($input);
        array_filter($result,
            function ($value) use ($self) {
                $self->processChar($value, $self);
            });

        if (substr($this->output, -1) == '(')
            $this->output = rtrim($this->output, '(');

        return $this->output;
    }
}

$utils = new ClearPar();

echo $utils->build(")()()(()()()(") . PHP_EOL;
