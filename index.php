<?php

require "Routing.php";

$path = $_SERVER["REQUEST_URI"];
$path = trim($path, '/');

Routing::get("index", "DefaultController");
Routing::get("result", "DefaultController");

Routing::run($path);
