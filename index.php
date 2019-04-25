<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/vendor/autoload.php';

$app = new \Slim\App();
date_default_timezone_set( "Africa/Luanda");
// Register api
require __DIR__ . '/src/router/clienteRouter.php';

require __DIR__ . '/src/router/clientePedidosRouter.php';

require __DIR__ . '/src/router/clienteLugaresRouter.php';

// Register routes
require __DIR__ . '/src/router/LojaRouter.php';
require __DIR__ . '/src/router/LojaAvaliacoesRouter.php';
require __DIR__.'/src/router/LojaPedidosRouter.php';

// Register routes
require __DIR__ . '/src/router/LojaProdutosRouter.php';
//require __DIR__ . '/src/router/ProdutosRouter.php';

// Register routes
require __DIR__ . '/src/router/PromocaoRouter.php';

// Run app
$app->run();