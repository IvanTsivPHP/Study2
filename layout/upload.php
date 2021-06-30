<?php

use App\DataUploader;

$uploader = new DataUploader($data['model'], $data['post']);
$uploader->rewrite('id', $data['post']['id']);
