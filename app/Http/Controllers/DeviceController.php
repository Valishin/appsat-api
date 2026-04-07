<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        return Device::all();
    }

    public function store(Request $request)
    {
        dd($request->all());
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type' => 'required|string',
            'brand' => 'nullable|string',
            'model' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'imei' => 'nullable|string',
            'sim' => 'nullable|string',
            'password' => 'nullable|string',
            'condition_notes' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $device = Device::create($validated);

        return response()->json($device, 201);
    }

    public function show(Device $device)
    {
        return $device;
    }

    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'type' => 'sometimes|string',
            'brand' => 'nullable|string',
            'model' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'imei' => 'nullable|string',
            'sim' => 'nullable|string',
            'password' => 'nullable|string',
            'condition_notes' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $device->update($validated);

        return $device;
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return response()->json(['message' => 'Deleted']);
    }
}