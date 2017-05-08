<?php
/**
 * Created by PhpStorm.
 * User: kento
 * Date: 5/5/17
 * Time: 12:13 AM
 */


/**
 * Class ChangeString
 */
class ChangeString {

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
            $_transformer = new AlphabetTransformer();
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

class AlphabetTransformer implements IStringTransformer
{

    /**
     * @var array
     */
    private $_alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'w', 'x', 'z'];
    /**
     * @var string
     */
    private $output;

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
     * @param AlphabetTransformer $context
     */
    private function processChar($char, $context)
    {
        $resultIndex = array_search(strtolower($char), $context->_alphabet, true);

        $foundIndex = $resultIndex !== false;

        if ($foundIndex && ctype_lower($char))
            $char = $context->getNextChar($resultIndex);
        else if ($foundIndex && ctype_upper($char))
            $char = $context->getNextChar($resultIndex, true);

        $context->output .= $char;
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
        return $this->output;
    }
}

$utils = new ChangeString();

echo $utils->build('asdasdASDAS123');
echo "\n";