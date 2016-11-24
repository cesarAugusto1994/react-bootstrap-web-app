<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 21/11/16
 * Time: 16:56
 */

$colecoes = $app['controllers_factory'];

$colecoes->get('colecoes/get', function() use ($app){
    $colecoes = $app['colecao.repository']->findBy([], ['nome' => 'ASC']);
    return new \Symfony\Component\HttpFoundation\JsonResponse($colecoes);
})->bind('api_colecoes');

$colecoes->get('colecao/{colecaoNome}', function ($colecaoNome) use ($app) {
    $colecao = $app['colecao.repository']->findBy(['nome' => $colecaoNome], ['nome' => 'ASC']);
    return $app['twig']->render('categorias.html.twig', ['colecao' => $colecao[0]]);
});

return $colecoes;