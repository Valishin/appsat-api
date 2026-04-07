<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Client::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:individual,company',
            'name' => 'required|string|max:255',
            'dni_cif' => 'required|string|max:20',
            'phone' => 'nullable|array',
            'email' => 'nullable|email|max:255',
            'notes' => 'nullable|string',

            'client_addresses' => 'nullable|array',
            'client_addresses.*.address' => 'nullable|string|max:255',
            'client_addresses.*.city' => 'nullable|string|max:100',
            'client_addresses.*.postal_code' => 'nullable|string|max:20',
            'client_addresses.*.province' => 'nullable|string|max:100',
            'client_addresses.*.country' => 'nullable|string|max:100',
            'client_addresses.*.label' => 'nullable|string|max:100',

            'devices' => 'nullable|array',
            'devices.*.type' => 'sometimes|required|string|max:255',
            'devices.*.brand' => 'sometimes|nullable|string|max:255',
            'devices.*.model' => 'sometimes|nullable|string|max:255',
            'devices.*.serial_number' => 'sometimes|nullable|string|max:255',
            'devices.*.imei' => 'sometimes|nullable|string|max:255',
            'devices.*.sim' => 'sometimes|nullable|string|max:255',
            'devices.*.password' => 'sometimes|nullable|string|max:255',
            'devices.*.condition_notes' => 'sometimes|nullable|string|max:255',
            'devices.*.notes' => 'sometimes|nullable|string|max:255',
        ]);

        return DB::transaction(function () use ($request, $validated) {            

            // Guardar solo datos de cliente
            $clientData = Arr::only($validated, ['type', 'name', 'dni_cif', 'phone', 'email', 'notes']);
            $client = Client::create($clientData);

            // Direcciones
            if (!empty($validated['client_addresses'])) {
                foreach ($validated['client_addresses'] as $addressData) {
                    $client->addresses()->create($addressData);
                }
            }

            // Dispositivos
            if (!empty($validated['devices'])) {
                foreach ($validated['devices'] as $deviceData) {
                    $client->devices()->create($deviceData);
                }
            }

            return response()->json(
                $client->load(['addresses', 'devices']),
                201
            );

        });

    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return response()->json($client);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $client->update($request->only([
            'name',
            'email',
            'phone'
        ]));

        return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json(['deleted' => true]);
    }

    public function checkDni(string $dni)
    {
        $exists = Client::where('dni_cif', $dni)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }
}
