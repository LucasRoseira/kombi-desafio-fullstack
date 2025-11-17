<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Jobs\SendClientRegisteredEmail;

class ClientController extends Controller
{
    public function store(StoreClientRequest $request)
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
