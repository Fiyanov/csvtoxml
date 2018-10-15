<?php
/**
 * Created by PhpStorm.
 * User: IF
 * Date: 15.10.2018
 * Time: 11:32
 */

class Transformer
{
    const DEFAULT_COURSE = 5.6;

    private $cost_index = 0;

    public function __construct($cost_index = null)
    {
        if ($cost_index) {
            $this->cost_index = $cost_index;
        }
    }

    public function make($data)
    {
        $row = [];
        foreach ($data as $index => $val) {
            if (is_numeric($val)) {
                $row['price'] = $val;
            } else {
                $row['code'] = $this->prepareCode($val);
            }
        }

        return $row;
    }

    public function prepareCode($code)
    {
        if (!$code) {
            return false;
        }

        if (is_numeric($code[0])) {
            preg_match('/(\d*)(\W?)([a-zA-Z]*)/', $code, $matches);

            $code = $matches[3] . '-' . $matches[1];
        }

        return $code;
    }
}