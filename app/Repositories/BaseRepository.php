<?php

namespace App\Repositories;

use App\Service\BaseService;

class BaseRepository implements BaseInterface
{
    public function all()
    {
        // TODO: Implement all() method.
        return $this->model->all();
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
        return $this->model->findOrFail($id);
    }

    public function paginateData($perPage)
    {
        // TODO: Implement paginateData() method.
        return $this->model->latest()->paginate($perPage);
    }
}
