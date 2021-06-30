<?php

namespace App\Controller\Admin;

use App\Controller\Controller;
use App\Model\Comments;
use App\View\View;

class CommentAdminController extends Controller
{
    public function comments(array $propArray = null)
    {
        $this->commentRevision();
        $commentModel = Comments::select('comments.id', 'author_id', 'article_id', 'date', 'text', 'username')
            ->leftjoin('users', 'users.id', '=', 'comments.author_id')
            ->where('moderated', '=', 0)
            ->orderBy('date', 'ASC')
            ->get()
            ->toArray();

        return new View('admin/comments',
            [
                'title'  => 'Commentaries management',
                'comments' => $commentModel
            ],
            'admin/header',
            'admin/footer'
        );
    }

    private function commentRevision()
    {
        if (!empty($_POST)) {
            $id = key($_POST);
            $val = array_shift($_POST);
            if ($val == 0) {
                Comments::destroy($id);
            } else {
                Comments::where('id', $id)->update(['moderated' => '1']);
            }
        }
    }
}
