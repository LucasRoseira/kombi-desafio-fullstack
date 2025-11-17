<?php

namespace App\Services;

use App\Models\Client;

class ClientService
{
    public function getAllClients(int $perPage, array $filters)
    {
        $query = Client::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (!empty($filters['state'])) {
            $query->where('state', $filters['state']);
        }
        if (!empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }

        return $query->paginate($perPage);
    }

    public function getStates(): array
    {
        return Client::query()
            ->select('state')
            ->distinct()
            ->orderBy('state')
            ->pluck('state')
            ->toArray();
    }

    public function getCitiesByState(string $state): array
    {
        return Client::query()
            ->where('state', $state)
            ->select('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city')
            ->toArray();
    }
    public function getSuppliers(array $filters): array
    {
        $query = Client::query();

        if (!empty($filters['state'])) {
            $query->where('state', $filters['state']);
        }
        if (!empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }

        return $query->select('name')->distinct()->orderBy('name')->pluck('name')->toArray();
    }
    public function createSupplier(array $data): Client
    {
        return Client::create($data);
    }
}
