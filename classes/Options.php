<?php
/**
 * Created by PhpStorm.
 * User: IF
 * Date: 15.10.2018
 * Time: 11:47
 */

class Options
{
    private $options;

    public function __construct()
    {
        $this->options = getopt(
    PARAM_SOURCE_FILE . ':' .
            PARAM_DELIMITER . '::' .
            PARAM_COURSE . '::' .
            PARAM_OFFSET . '::' .
            PARAM_PRICE . '::' .
            PARAM_ARTICLE . '::' .
            PARAM_HELP . '::'
        );
    }

    public function get($param)
    {
        if (isset($this->options[$param])) {
            return $this->options[$param];
        }

        return false;
    }

    public function has($param)
    {
        return isset($this->options[$param]);
    }

    public function all()
    {
        return $this->options;
    }
}