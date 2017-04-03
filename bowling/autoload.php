<?php
function __autoload($className)
{
    $file = "{$className}.php";
    if (file_exists($file)) {
        require $file;
    } else {
        throw new Exception('File not found');
    }
}

?>