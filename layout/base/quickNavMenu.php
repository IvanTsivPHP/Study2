<div class="quick-nav">
<aside class="bd-aside sticky-xl-top text-muted align-self-start mb-3 mb-xl-5 px-2">
    <h2 class="h6 pt-4 pb-3 mb-4 border-bottom">Quick navigation</h2>
    <nav class="small" id="toc">
        <ul class="list-unstyled">
            <?=accessCheck(6)?'<li><a class="d-inline-flex align-items-center rounded" href="/admin/users">Users and roles</a></li>':''?>
            <li><a class="d-inline-flex align-items-center rounded" href="/admin/posts">Articles</a></li>
            <?=accessCheck(6)?'<li><a class="d-inline-flex align-items-center rounded" href="/admin/subs">Subscribers</a></li>':''?>
            <li><a class="d-inline-flex align-items-center rounded" href="/admin/comments">Comments</a></li>
            <li><a class="d-inline-flex align-items-center rounded" href="/admin/pages">Static pages</a></li>
            <?=accessCheck(6)?'<li><a class="d-inline-flex align-items-center rounded" href="/admin/config">Config</a></li>':''?>
        </ul>
    </nav>
</aside>
</div>