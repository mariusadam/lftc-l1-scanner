<?php

class Token
{
    const T_IDENTIFIER = 'identifier';
    const T_CONSTANT = 'constant';
    const T_OPERATOR = 'operator';
    const T_SEPARATOR = 'separator';
    const T_KEYWORD = 'keyword';

    /**
     * @var string
     */
    private $type;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var int
     */
    private $line;

    /**
     * @var int
     */
    private $col;

    /**
     * Token constructor.
     *
     * @param string $type
     * @param mixed  $value
     */
    public function __construct($type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $line
     *
     * @return Token
     */
    public function setLine(int $line): Token
    {
        $this->line = $line;

        return $this;
    }

    /**
     * @param int $col
     *
     * @return Token
     */
    public function setCol(int $col): Token
    {
        $this->col = $col;

        return $this;
    }

    /**
     * @return int
     */
    public function getLine(): int
    {
        return $this->line;
    }

    /**
     * @return int
     */
    public function getCol(): int
    {
        return $this->col;
    }

    public function __toString()
    {
        return sprintf(
            '\'%s\' (%s) at line: %s, col: %s',
            $this->getValue(),
            $this->getType(),
            $this->getLine(),
            $this->getCol()
        );
    }
}