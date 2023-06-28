<?php

declare(strict_types=1);

namespace App\Repositories\Db;

use App\Models\Debt;
use App\Repositories\Db\Contracts\AbstractDebtRepository;
use Illuminate\Database\Eloquent\Collection;

class DebtRepository extends AbstractDebtRepository
{
    private $model;

    public function __construct(Debt $model)
    {
        $this->model = $model;
    }

    public function find(string $id): ?Debt
    {
        return $this->model->where('id', $id)->first();
    }

    public function findMany(array $id): ?Collection
    {
        return $this->model->whereIn('id', $id)->get();
    }

    public function findByName($name): ?Collection
    {
        return $this->model->where('name', 'like', '%' . $name . '%')->get();
    }

    public function create(array $data): Debt
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): ?Debt
    {
        $debt = $this->model->findOrFail($id);
        $debt->update($data);

        return $debt;
    }


    public function firstOrNew(array $debt): Debt
    {
        return $this->model::updateOrCreate(
            ['id' => (string) $debt['id']],
            $debt
        );
    }

}
