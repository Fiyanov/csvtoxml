<?php
/**
 * Created by PhpStorm.
 * User: IF
 * Date: 15.10.2018
 * Time: 11:31
 */

class Reader
{
    private $file = null;
    private  $delimiter = ',';

    public function __construct($delimiter = ',')
    {
        if ($delimiter) {
            $this->delimiter = $delimiter;
        }
    }

    public function open($file_name)
    {
        if (!$file_name) {
            return false;
        }

        try {
            $this->file = fopen($file_name, 'r');
        } catch (Exception $exception) {

        }

        return true;
    }

    public function get()
    {
        if (!$this->file) {
            return false;
        }

        return fgetcsv($this->file, 0, $this->delimiter);
    }
}