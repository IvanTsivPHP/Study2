<?php
use App\Model\StaticPages;
?>
<div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
        <a class="p-2 link-secondary" href="/">Main page</a>
        <a class="p-2 link-secondary" href="/my-profile">Profile</a>
        <?php
        $menu = StaticPages::select('href', 'title')
        ->get()
        ->toArray();
        foreach ($menu as $item) {
            echo '<a class="p-2 link-secondary" href="'. $item['href'] .'">' . $item['title'] . '</a>';
        }

        echo accessCheck(3)?'<a class="p-2 link-secondary" href="/admin/posts">Administration</a>':''?>
    </nav>
</div>
