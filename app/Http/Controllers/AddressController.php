<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',        
            'postal_code' => 'required|string|max:20',
            'province' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'label' => 'nullable|string|max:100'
        ]);

        $address = Address::create($validated);

        return response()->json($address, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
