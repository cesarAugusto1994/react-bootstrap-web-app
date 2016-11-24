<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 21/11/16
 * Time: 10:37
 */

$app->get('/', function() use ($app) {
    return $app['twig']->render('index.html.twig');
});

$app->get('login', function() use ($app) {
    return $app['twig']->render('login.html.twig');
});

$app->get('/user/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});

$app->post('/admin/login_check', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {})->bind('login_check');

$app->mount('/user', include __DIR__ . '/controllers/colecoes.php');
$app->mount('/user', include __DIR__ . '/controllers/categorias.php');
$app->mount('/user', include __DIR__ . '/controllers/musicas.php');