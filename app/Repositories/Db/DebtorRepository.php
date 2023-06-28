<?php

declare(strict_types=1);

namespace App\Repositories\Db;

use App\Models\Debtor;
use App\Repositories\Db\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class DebtorRepository implements RepositoryContract
{
    private $model;

    public function __construct(Debtor $model)
    {
        $this->model = $model;
    }

    public function find(string $id): ?Debtor
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

    public function create(array $data): Debtor
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): ?Debtor
    {
        $debtor = $this->model->findOrFail($id);
        $debtor->update($data);

        return $debtor;
    }


    public function firstOrNewByGovernmentId(array $debtor): Debtor
    {
        return $this->model::updateOrCreate(
            ['government_id' => (string) $debtor['government_id']],
            $debtor
        );
    }

}
