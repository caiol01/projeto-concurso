<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Utils\Filters\LowerThanFilter;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class VehicleRepository
{
    private $model;

    public function __construct(Vehicle $model)
    {
        $this->model = $model;
    }

    public function store(array $data): Vehicle {
        return $this->model->create($data);
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator {
        $vehicles = QueryBuilder::for(Vehicle::class)
        ->allowedFilters([
            'name',
            'brand',
            'city',
            'type',
            AllowedFilter::custom('vehicle_year', new LowerThanFilter),
            AllowedFilter::custom('kilometers', new LowerThanFilter),
            AllowedFilter::custom('price', new LowerThanFilter)
        ])
        ->paginate($perPage);

        return $vehicles;
    }

    public function findById(int $id): ?Vehicle
    {
        $vehicle = QueryBuilder::for(Vehicle::class)
            ->where('id', $id)
            ->first();

        return $vehicle;
    }

    public function update(int $id, array $data): bool {
        $vehicle = $this->findById($id);

        if(!$vehicle){
            return false;
        }

        return $vehicle->update($data);
    }

    public function delete(int $id): bool {
        $vehicle = $this->findById($id);

        if(!$vehicle){
            return false;
        }

        return $vehicle->delete($id);
    }
}
