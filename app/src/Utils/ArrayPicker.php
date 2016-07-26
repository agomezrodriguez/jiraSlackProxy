<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 18/07/16
 * Time: 10:14
 */

namespace I4Proxy\Utils;

class ArrayPicker {

    private $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            return $default;
        }
    }

    public function all()
    {
        return $this->data;
    }

}

