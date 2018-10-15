<?php
/**
 * Created by PhpStorm.
 * User: IF
 * Date: 15.10.2018
 * Time: 11:31
 */

class Writer
{
    const BUFFER_XML_COUNT = 100;

    private $file = '';
    private $xml = null;
    private $line_counter = 0;

    public function __construct($file = '')
    {
        if ($file && is_string($file)) {
            $this->file = $this->changeExtension($file);
        }

        $this->xml = new XMLWriter();
        $this->xml->openMemory();
        $this->xml->startDocument("1.0");
        $this->xml->startElement("items");
    }

    public function setFileName($file)
    {
        $this->file = $this->changeExtension($file);
    }

    public function setData($data)
    {
        $this->line_counter++;

        $this->xml->startElement('item');

        $this->xml->startElement('code');
        $this->xml->text($data['code']);
        $this->xml->endElement();

        $this->xml->startElement('price');
        $this->xml->text($data['price']);
        $this->xml->endElement();

        $this->xml->endElement();

        if ($this->line_counter % self::BUFFER_XML_COUNT == 0) {
            file_put_contents($this->file, $this->xml->flush(true), FILE_APPEND);
        }
    }

    public function save()
    {
        $this->xml->endElement();
        $this->xml->endDocument();
        file_put_contents($this->file, $this->xml->flush(true), FILE_APPEND);
    }

    private function changeExtension($file)
    {
        $file = basename($file);
        $file = explode('.', $file);
        return  $file[0] . '.xml';
    }
}