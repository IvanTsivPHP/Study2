<?php
namespace App\Controller\User;

use App\Config;
use App\Controller\Controller;
use App\Exception\NotFoundException;
use App\Model\Blog;
use App\Paginator;
use App\View\View;

class ArticleController extends Controller
{
    private $commentController;

    public function __construct()
    {
        $this->commentController = new CommentController('0');
    }

    public function listArticles()
    {
        $disableUnsub = null;
        $blogModel = Blog::select('articles.id', 'title', 'subtitle', 'date', 'username', 'author', 'pic')
            ->leftjoin('users', 'users.id', '=', 'articles.author')
            ->skip(calcSkip(Config::get('blogPaginationLimit')))
            ->take(getPaginationLimit(Config::get('blogPaginationLimit')))
            ->orderBy('id', 'DESC')
            ->get()
            ->toArray();

        if (!empty($_SESSION['id']) && $_SESSION['sub'] === true) {
            $disableUnsub = true;
        }
        $_POST = [];

        return new View('mainPage',
            [
                'title' => 'Main page',
                'posts' => $blogModel,
                'pagination' => (new Paginator('Blog', Config::get('blogPaginationLimit')))->run(),
                'disableUnsub' => $disableUnsub
            ]
        );
    }

    public function viewArticle(array $propArray = null)
    {
        $commentStatus = $this->commentController->newComment();
        $model = Blog::select('articles.id', 'title', 'text', 'pic', 'subtitle', 'date', 'username', 'author', 'pic')
            ->leftjoin('users', 'users.id', '=', 'articles.author')
            ->where('articles.id', '=', $propArray)
            ->first();

        if (empty($model)) {
            throw new NotFoundException();
        }

        return new View('blogPost',
            [
                'title' => $model['title'],
                'post' => $model,
                'comments' => $this->commentController->commentSection($model['id']),
                'commentStatus' => $commentStatus
            ]
        );
    }
}
