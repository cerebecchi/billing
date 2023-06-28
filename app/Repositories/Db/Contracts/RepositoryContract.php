<?php

namespace App\Repositories\Db\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryContract
{
    public function create(array $data): Model;

    public function find(string $id): ?Model;

    public function update(string $id, array $data): ?Model;

}
