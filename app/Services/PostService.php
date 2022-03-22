<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Post;

use URL;

class PostService extends BaseService
{
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }
    
}
