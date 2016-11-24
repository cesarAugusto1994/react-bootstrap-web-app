<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 22/11/16
 * Time: 13:43
 */

$categorias = $app['controllers_factory'];

$categorias->get('categorias/get', function () use ($app) {
    $categorias = $app['categoria.repository']->findBy(['ativo' => true]);
    return new \Symfony\Component\HttpFoundation\JsonResponse($categorias);
});

return $categorias;