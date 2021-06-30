<?php
namespace App\Controller\User;

use App\Controller\Controller;
use App\DataUploader;
use App\Exception\LoginRequiredException;
use App\Model\Comments;

class CommentController extends Controller
{
    public function commentSection($id)
    {
        if (isset($_SESSION['id'])) {
            $this->userId = $_SESSION['id'];
        } else {
            $this->userId = 0;
        }

        return Comments::select('comments.id', 'moderated', 'author_id', 'date', 'text', 'username', 'userpic', 'article_id')
            ->leftjoin('users', 'users.id', '=', 'comments.author_id')
            ->where('article_id', '=', $id)
            ->where(function ($query) {
                $query->where('moderated', '=', '1')
                    ->orWhere('author_id', '=', $this->userId);
            })
            ->orderBy('id', 'ASC')
            ->get()
            ->toArray();
    }

    public function newComment()
    {
        if (isset($_POST['text']) && !empty($_POST['text'])) {
            //guest error
            if ($this->user['access'] === 0) {
                return ['danger', 'You must be logged in to leave comments.'];
            }
            //auto moderation for manager/admin
            if ($this->user['access'] >= 3) {
                $_POST['moderated'] = 1;
            } else {
                $_POST['moderated'] = 0;
            }
            $commentUploader = new DataUploader('Comments', $this->prepData());
            $commentUploader->newRow();
            header("refresh: 0");

            return ['success', 'Great success!'];
        }
        return ['', null];
    }

    private function prepData()
    {
        return [
            'author_id' => $_POST['author_id'],
            'article_id' => $_POST['article_id'],
            'text' => $_POST['text'],
            'moderated' => $_POST['moderated']
        ];
    }
}
