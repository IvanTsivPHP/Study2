<?php

namespace App\Controller\Admin;

use App\Config;
use App\Controller\Controller;
use App\DataUploader;
use App\Exception\NotFoundException;
use App\Model\Blog;
use App\Paginator;
use App\PicUpLoader;
use App\Subscription;
use App\View\View;
use App\Model\Comments;
use App\Controller\User\CommentController;

class ArticleAdminController extends Controller
{
    private $commentController;

    public function __construct()
    {
        $this->commentController = new CommentController('3');
    }

    public function listArticles()
    {
        $this->deleteArticle();
        $blogModel = Blog::select('articles.id', 'pic', 'title', 'username', 'date')
            ->leftjoin('users', 'users.id', '=', 'articles.author')
            ->skip(calcSkip(Config::get('blogPaginationLimit')))
            ->take(getPaginationLimit(Config::get('blogPaginationLimit')))
            ->orderBy('id', 'DESC')
            ->get()
            ->toArray();

        return new View('admin/articles',
            [
                'title' => 'Articles management',
                'tableHeader' => ['Picture', 'ID', 'Article', 'Author', 'Date'],
                'tableContent' => $blogModel,
                'pagination' => (new Paginator('Blog', Config::get('blogPaginationLimit')))->run()
            ],
            'admin/header',
            'admin/footer'
        );
    }

    private function deleteArticle()
    {
        if (isset($_POST['delete'])) {
            Blog::where('id', $_POST['delete'])->delete();
        }
    }

    public function editArticle(array $propArray = null)
    {
        $this->deleteComment();
        $status = $this->uploadArticle($propArray);
        $model = Blog::select('articles.id', 'title', 'text', 'pic', 'subtitle', 'date', 'username', 'author', 'pic')
            ->leftjoin('users', 'users.id', '=', 'articles.author')
            ->where('articles.id', '=', $propArray)
            ->first();

        if (empty($model)) {
            throw new NotFoundException();
        }

        return new View('admin/articleEditor',
            [
                'title' => $model['title'],
                'post' => $model,
                'button' => 'Save',
                'status' => $status,
                'comments' => $this->commentController->commentSection($model['id'])
            ],
            'admin/header',
            'admin/footer'
        );
    }

    public function newArticle()
    {
        $status = $this->uploadNewArticle();

        return new View('admin/articleEditor',
            [
                'title' => 'New post',
                'post' => $_POST,
                'button' => 'Upload post',
                'status' => $status,
                'comments' => []
            ],
            'admin/header',
            'admin/footer'
        );
    }

    private function uploadArticle($propArray)
    {
        if (!empty($_POST) && !isset($_POST['delete'])) {
            $model = new DataUploader('Blog', $this->prepData());
            $model->rewrite('id', $propArray);
            $postId = $propArray;

            return $this->uploadPic($postId);
        }
    }

    private function deleteComment()
    {
        if (isset($_POST['delete'])) {
            Comments::where('id', $_POST['delete'])->delete();
        }
    }

    private function uploadNewArticle()
    {
        if (!empty($_POST)) {
            $model = new Blog();
            if (Blog::where('text', '=', $_POST['text'])->first()) {

                return 'Article with this content are already exists';
            }
            foreach ($this->prepData() as $key => $value) {
                $model->$key = $value;
            }
            $model->save();
            $postId = $model->id;
            $sub = new Subscription($postId);
            $sub->run();
            $this->uploadPic($postId);

            header('Location: /admin/posts');
        }
    }

    private function uploadPic($postId)
    {
        if (!empty($_FILES) && $_FILES['img']['error'] !== 4) {
            $loader = new PicUpLoader('/img/post/', $postId);
            $status = $loader->run();
            if ($status == false) {
                $model = new DataUploader('Blog', ['pic' => $loader->getPicName()]);
                $model->rewrite('id', $postId);
                $status = 'Picture uploaded';
            }

            return $status;
        }
    }

    private function prepData()
    {
        return [
            'title' => $_POST['title'],
            'subtitle' => $_POST['subtitle'],
            'text' => $_POST['text'],
            'author' => $_POST['author']
        ];
    }
}
