<?php

error_reporting(E_ALL);
ini_set('display_errors',true);
require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .'helpers.php';
require $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .'bootstrap.php';

use App\Router;
use App\Application;
use App\Controller\ProfileController;
use App\Controller\User\AuthController;
use App\Controller\User\ArticleController;
use App\Controller\SignUpController;
use App\Controller\BlogController;
use App\Controller\StaticController;
use App\Controller\Admin\UserAdminController;
use App\Controller\Admin\ArticleAdminController;
use App\Controller\Admin\CommentAdminController;
use App\Controller\Admin\StaticPagesAdminController;
use App\Controller\Admin\SubscribeAdminController;
use App\Controller\Admin\ConfigAdminController;
use App\Model\StaticPages;
use App\Session;


$router = new Router(new Session());
$router->session->start();

$router->get('/', ArticleController::class . '@listArticles', 0);
$router->get('/login', AuthController::class . '@login', 0);
$router->get('/login', AuthController::class . '@login', 0, 'POST');
$router->get('/signup', SignUpController::class . '@signup', 0);
$router->get('/signup', SignUpController::class . '@signup', 0, 'POST');
$router->get('/logout', AuthController::class . '@logout', 0);
$router->get('/subscribe', ProfileController::class . '@subscribeUser', 0, 'POST');
$router->get('/unsubscribe', ProfileController::class . '@unsubscribeUser', 0);
$router->get('/admin/users', UserAdminController::class . '@listUsers', 6);
$router->get('/admin/posts', ArticleAdminController::class . '@listArticles', 3);
$router->get('/admin/posts', ArticleAdminController::class . '@listArticles', 3, 'POST');
$router->get('/admin/posts/*', ArticleAdminController::class . '@editArticle', 3);
$router->get('/admin/posts/*', ArticleAdminController::class . '@editArticle', 3, 'POST');
$router->get('/admin/users/*', UserAdminController::class . '@userPage', 6);
$router->get('/admin/users/*', UserAdminController::class . '@userPage', 6, 'POST');
$router->get('/admin/comments', CommentAdminController::class . '@comments',3);
$router->get('/admin/comments', CommentAdminController::class . '@comments',3, 'POST');
$router->get('/admin/pages', StaticPagesAdminController::class . '@staticPages',3);
$router->get('/admin/pages', StaticPagesAdminController::class . '@staticPages',3, 'POST');
$router->get('/admin/new-page', StaticPagesAdminController::class . '@newPage',6);
$router->get('/admin/new-page', StaticPagesAdminController::class . '@newPage',6, 'POST');
$router->get('/admin/pages/*', StaticPagesAdminController::class . '@editPage',3);
$router->get('/admin/pages/*', StaticPagesAdminController::class . '@editPage',3, 'POST');
$router->get('/my-profile', ProfileController::class . '@profile',1);
$router->get('/my-profile', ProfileController::class . '@profile',1, 'POST');
$router->get('/profile/*', ProfileController::class . '@profile',1);
$router->get('/post/*', ArticleController::class . '@viewArticle',0);
$router->get('/post/*', ArticleController::class . '@viewArticle',0, 'POST');
$router->get('/admin/new-post', ArticleAdminController::class . '@newArticle', 3);
$router->get('/admin/new-post', ArticleAdminController::class . '@newArticle', 3, 'POST');
$router->get('/admin/subs', SubscribeAdminController::class . '@editSubscribes', 6);
$router->get('/admin/subs', SubscribeAdminController::class . '@editSubscribes', 6, 'POST');
$router->get('/admin/config', ConfigAdminController::class . '@listConfig', 6);
$router->get('/admin/config', ConfigAdminController::class . '@listConfig', 6, 'POST');

$application = new Application($router);

$staticPages = StaticPages::select('*')
    ->get()
    ->toArray();
foreach ($staticPages as $page) {
    $router->get($page['href'], StaticController::class . '@run', 0);
}

$application->run();

