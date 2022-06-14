<?php

require "Routing.php";

$path = $_SERVER["REQUEST_URI"];
$path = trim($path, '/');

Routing::get("index", "DefaultController");
Routing::get("login", "DefaultController");
Routing::get("results", "DefaultController");

Routing::run($path);
