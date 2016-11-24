<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());

$app->register(new Silex\Provider\SecurityServiceProvider());
$app['security.default_encoder'] = function ($app) {
    return $app['security.encoder.digest'];
};
$app['security.encoder.digest'] = function () {
    return new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha1', false, 1);
};
$app['security.encoder_factory'] = function ($app) {
    return new \Symfony\Component\Security\Core\Encoder\EncoderFactory(
        array(
            'Symfony\Component\Security\Core\User\UserInterface' => $app['security.encoder.digest'],
            'Entity\User' => $app['security.encoder.digest'],
        )
    );
};
$app['security.firewalls'] = array(
    'secured' => array(
        'pattern' => '^/admin/',
        'form' => array(
            'login_path' => '/login',
            'check_path' => '/admin/login_check',
            'always_use_default_target_path' => true,
            'default_target_path' => '/redirect',
        ),
        'logout' => array(
            'logout_path' => '/admin/logout',
            'invalidate_session' => true,
        ),
        'remember_me' => array(
            'secret'   => '%secret%',
            'lifetime' => 10000, // 1 week in seconds
            'path'     => '/user/',
            // by default, the feature is enabled by checking a
            // checkbox in the login form (see below), uncomment
            // the following line to always enable it.
            //'always_remember_me' => true,
        ),
        'users' => function () use ($app) {
            return new Security\UserProvider($app['db'], $app);
        },
    ),
);
$app['security.access_rules'] = array(
    array('^/login$', 'IS_AUTHENTICATED_ANONYMOUSLY'),
    array('^/admin/$', 'ROLE_ADMIN'),
    array('^/users/$', 'ROLE_ADMIN'),
    array('^/users/$', 'ROLE_USER'),
    array('^/auth', 'ROLE_USER')
);
$app['security.role_hierarchy'] = array(
    'ROLE_ADMIN' => array('ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH'),
);
$app->register(new \Silex\Provider\SessionServiceProvider());
$app['session.storage.save_path'] = __DIR__ . '/../var/cache/sessions/';
$app['session.storage.options'] = ['cookie_lifetime' => 3600];
$app['session']->start();
$app->register(new Silex\Provider\RememberMeServiceProvider());

$app->register(new \Silex\Provider\TwigServiceProvider(),
    array(
        'twig.path' => __DIR__ . '/../src/Api/Resources/Views/',
        'twig.options' => array(
            'cache' => __DIR__ . '/../var/cache/twig',
            'strict_variables' => true,
        ),
    )
);
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    
    return $twig;
});
$app->register(new \Silex\Provider\FormServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());

include_once __DIR__ . '/../app/services.php';
include_once __DIR__ . '/../app/providers.php';
include_once __DIR__ . '/../app/controllers.php';
include_once __DIR__ . '/../app/middlewares.php';

return $app;
