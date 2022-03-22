<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Post;

class PostRepository extends BaseRepository
{

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->getById($id);
    }

    public function paginateData($paginate = 5)
    {
        return $this->model->paginateData($paginate);
    }

}
