<?php
/**
 * Created by PhpStorm.
 * User: IF
 * Date: 15.10.2018
 * Time: 11:31
 */

class Parser
{
    const DEFAULT_OFFSET = 1;

    public function run()
    {
        $options = new Options();
        $reader = new Reader($options->get(PARAM_DELIMITER));
        $writer = new Writer();
        $transformer = new Transformer();

        if ($options->has(PARAM_HELP)) {
            return "
                -h Help
                -s Source file name
                -d Delimiter
                -c Course (default 5.6)
                -o Offset line number
                -p Price column number
            ";
        }

        if (!$options->get(PARAM_SOURCE_FILE)) {
            return "Parameter for CSV file not set!\r\n";
        }

        $reader->open($options->get(PARAM_SOURCE_FILE));

        $step = -1;
        $offset = self::DEFAULT_OFFSET;

        if ($options->has(PARAM_OFFSET)) {
            $offset = $options->get(PARAM_OFFSET);
            echo "offset $offset \r\n";
        }

        $xml_data = [];

        while ($data = $reader->get()) {
            $step++;

            if ($step < $offset) {
                continue;
            }

            $xml_data[] = $transformer->make($data);
        }

        return 'run ' . json_encode($xml_data);
    }
}