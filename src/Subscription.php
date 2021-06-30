<?php

namespace App;

use App\Model\Subscribes;

class Subscription
{
    private $list;
    private $text;
    private $link;

    public function __construct($link)
    {
        $this->list = Subscribes::select('subscribes.id', 'username', 'subscribes.email')
            ->leftJoin('users', 'users.email', '=', 'subscribes.email')
            ->get()
            ->toArray();
        $this->link = 'http://' . $_SERVER['HTTP_HOST'] . '/post/' . $link;
        $this->text = file_get_contents(APP_DIR . '/configs/email.txt');
    }

    public function run()
    {
        $file = fopen(APP_DIR . '/mailing.txt', 'w');
        foreach ($this->list as $user) {
            if (empty($user['username'])) {
                $user['username'] = 'Friend';
            }
            $date = date('Y-m-d H:i:s') . "\n";
            $search = ['<username>', '<email>', '<unsubLink>', '<link>'];
            $replace = [$user['username'], $user['email'], $this->getLink($user['id']), $this->link];
            $text = str_replace($search, $replace, $this->text);
            $text = $date . $text . "-------------------------\n";
            fwrite($file, $text);
        }
        fclose($file);
    }

    private function getLink($id)
    {
        return $_SERVER['HTTP_HOST'] . "/unsubscribe?id=$id&validation_hash=".md5($id . SECRET_STRING);
    }
}
