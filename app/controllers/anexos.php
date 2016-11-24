<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 24/11/16
 * Time: 08:42
 */

$anexos = $app['controllers_factory'];

$anexos->get('musica/{musica}/anexos', function ($musica) use ($app) {
    $musica = $app['musica.repository']->find($musica);
    $anexos = $app['musica.anexos.repository']->findBy(['musica' => $musica], ['numero' => 'ASC', 'nome' => 'ASC']);
    return new \Symfony\Component\HttpFoundation\JsonResponse($anexos);
});

return $anexos;