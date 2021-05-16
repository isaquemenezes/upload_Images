<?php
    header("Content-Type: text/html; charset=utf-8");
    //Incluindo o composer no meu arquivo
    include 'config/config.php';
    include 'lib/vendor/autoload.php';
    include 'helpers/variables.php';

    $dispatch = new Classes\ClassDispatch();
    include ($dispatch->getInclusao());