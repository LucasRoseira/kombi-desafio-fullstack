<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Jobs\SendClientRegisteredEmail;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    public function __construct(private readonly ClientService $clientService) {}

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['name', 'state', 'city']);
        $perPage = $request->get('per_page', 10);

        $paginated = $this->clientService->getAllClients($perPage, $filters);

        return response()->json($paginated);
    }

    public function getStates(): JsonResponse
    {
        $states = $this->clientService->getStates();
        return response()->json($states);
    }

    public function getCities(Request $request): JsonResponse
    {
        $state = $request->get('state');
        if (!$state) {
            return response()->json(['message' => 'O estado é obrigatório'], 400);
        }

        $cities = $this->clientService->getCitiesByState($state);
        return response()->json($cities);
    }

    public function getSuppliers(Request $request): JsonResponse
    {
        $filters = $request->only(['state', 'city']);
        if (empty($filters['state']) || empty($filters['city'])) {
            return response()->json([], 200);
        }

        $suppliers = $this->clientService->getSuppliers($filters);
        return response()->json($suppliers);
    }

    public function store(StoreClientRequest $request): JsonResponse
    {
        $data = $request->validated();
        $client = Client::create($data);

        SendClientRegisteredEmail::dispatch($client);

        return response()->json([
            'message' => 'Cliente cadastrado com sucesso.',
            'data' => $client
        ], 201);
    }
}
