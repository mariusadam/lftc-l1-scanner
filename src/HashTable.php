<?php

class HashTable
{
    private $code;
    private $map;

    public function __construct()
    {
        $this->code = -1;
        $this->map = array();
    }

    public function put($value)
    {
        if (isset($this->map[$value])) {
            return $this->map[$value];
        }

        $this->code++;
        $this->map[$value] = $this->code;
        return $this->code;
    }

    public function toArray()
    {
        return $this->map;
    }
}