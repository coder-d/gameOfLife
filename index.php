<?php

require 'config.php';


function __autoload($class) {
require LIBS . $class .".php";
}





$app = new Bootstrap();
