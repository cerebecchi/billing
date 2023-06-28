<?php

declare(strict_types=1);

namespace App\Repositories\Db\Contracts;

use App\Models\Debt;
use App\Repositories\Db\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractDebtRepository implements RepositoryContract
{
    public function create(array $data): Model
    {
        return Debt::create($data);
    }

    public function find(string $id): ?Model
    {
        return Debt::find($id);
    }

    public function update(string $id, array $data): ?Model
    {
        $debt = Debt::find($id);
        if ($debt) {
            $debt->update($data);
        }

        return $debt;
    }
}
