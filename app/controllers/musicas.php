<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 22/11/16
 * Time: 15:23
 */

$musicas = $app['controllers_factory'];

$musicas->get('categoria/{categoria}/musicas', function ($categoria) use ($app) {
    $categoria = $app['categoria.repository']->findBy(['nome' => $categoria]);
    $musicas = $app['musica.repository']->findBy(['categoria' => $categoria[0]], ['numero' => 'ASC', 'nome' => 'ASC']);
    return new \Symfony\Component\HttpFoundation\JsonResponse($musicas);
});

$musicas->get('colecao/{colecao}/musicas', function ($colecao) use ($app) {
    $colecao = $app['colecao.repository']->find($colecao);
    $categorias = $app['categoria.repository']->findBy(['colecao' => $colecao]);
    $musicas = $app['musica.repository']->findBy(['categoria' => $categorias[0]], ['numero' => 'ASC', 'nome' => 'ASC']);
    return new \Symfony\Component\HttpFoundation\JsonResponse($musicas);
});

$musicas->get('musica/{musica}/get', function ($musica) use ($app) {
    $musica = $app['musica.repository']->find($musica);
    return new \Symfony\Component\HttpFoundation\JsonResponse($musica);
});

$musicas->get('musica/{musica}', function ($musica) use ($app) {
    $musica = $app['musica.repository']->findBy(['nome' => $musica]);
    return $app['twig']->render('musica.html.twig', ['musica' => $musica[0]]);
});

return $musicas;