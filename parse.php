<?php

spl_autoload_register(function ($class) {
    include 'classes' . DIRECTORY_SEPARATOR . $class . '.php';
});

const PARAM_SOURCE_FILE = 's';
const PARAM_DELIMITER = 'd';
const PARAM_COURSE = 'c';
const PARAM_OFFSET = 'o';
const PARAM_PRICE = 'p';
const PARAM_ARTICLE = 'a';
const PARAM_HELP = 'h';

echo (new Parser())->run();