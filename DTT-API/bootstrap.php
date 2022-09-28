<?php

use Dotenv\Dotenv;

use Src\System\DatabaseConnector;

$dotenv = new DotEnv(__DIR__);
$dotenv->load();

$dbConnection = (new DatabaseConnector())->getConnection();
// test code, should output:
// api://default
// when you run $ php bootstrap.php
//echo getenv('OKTAAUDIENCE');
