<?php

/*
echo "<pre>";
var_dump($_SERVER);
echo "</pre>";
*/

function redirect($route) {

    return new class($route)
    {
        private $route;

        public function __construct($route)
        {
            $this->route = $route;
            header("Location: ".$this->route, true, 302);
            exit;
        }
    };
}


/* Route for the example */
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

if ($uri == '/') {
    require_once 'pages/home.php';
    sleep(2);
    redirect('/about');
} else if ($uri == '/about') {
    require_once 'pages/about.php';
    sleep(2);
    redirect('/');
} else {
    http_response_code(404);
}
