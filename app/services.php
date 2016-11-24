<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 21/11/16
 * Time: 17:00
 */

/**
 * Repositorios
 */

$app['menu.repository'] = function () use($app) { return $app['orm.em']->getRepository(\App\Entities\Menu::class);};
$app['config.repository'] = function () use($app) { return $app['orm.em']->getRepository(\App\Entities\Config::class);};
$app['posts.repository'] = function () use ($app) { return $app['orm.em']->getRepository(\Api\Entities\Posts::class);};
$app['tags.repository'] = function () use ($app) { return $app['orm.em']->getRepository(\Api\Entities\Tags::class);};
$app['posts.links.repository'] = function () use ($app) { return $app['orm.em']->getRepository(\Api\Entities\LinksPosts::class);};
$app['musica.repository'] = function () use ($app) { return $app['orm.em']->getRepository(\Api\Entities\Musica::class);};
$app['musica.anexos.repository'] = function () use ($app) { return $app['orm.em']->getRepository(\Api\Entities\MusicaAnexos::class);};
$app['tipo.anexo.repository'] = function () use ($app) { return $app['orm.em']->getRepository(\Api\Entities\Tipo::class);};
$app['usuarios.repository'] = function () use ($app) { return $app['orm.em']->getRepository(\Api\Entities\Usuarios::class);};
$app['colecao.repository'] = function () use ($app) { return $app['orm.em']->getRepository(\Api\Entities\Colecao::class);};
$app['categoria.repository'] = function () use ($app) { return $app['orm.em']->getRepository(\Api\Entities\Categoria::class);};
$app['log.repository'] = function () use ($app) { return $app['orm.em']->getRepository(\Api\Entities\Log::class);};
$app['comentario.repository'] = function () use ($app) { return $app['orm.em']->getRepository(\Api\Entities\Comentarios::class);};
$app['album.repository'] = function () use ($app) { return $app['orm.em']->getRepository(\Api\Entities\Album::class);};

$app['database'] = function () use ($app){
    return [
        'dbname' => 'blog',
        'user' => 'root',
        'password' => 'mestre',
        'host' => 'mysql',
        'port' => 3300,
        'driver' => 'pdo_mysql',
    ];
};

$app['site.config'] = function () use ($app) {
    $apresentacao = $app['config.repository']->find([], ['id' => 'DESC'], 3);
    return new \Symfony\Component\HttpFoundation\JsonResponse($apresentacao);
};