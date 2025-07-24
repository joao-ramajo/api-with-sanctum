<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // retorna todos os clientes da base de dados
        return response()
            ->json(
                Client::paginate(10),
                200
            );
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
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ]
        );

        $client = Client::create($request->all());

        return response()
            ->json([
                'message' => 'Client created successfully',
                'data' => $client
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()
                ->json([
                    'status' => 'ok',
                    'message' => 'User not found or not exists',
                ], 200);
        }

        return response()
            ->json(
                [
                    'status' => 'ok',
                    'message' => 'success',
                    'data' => $client
                ],
                200
            );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:clients,email,' . $id,
                'phone' => 'required',
            ]
        );

        $client = Client::find($id);

        if (!$client) {
            return response()
                ->json([
                    'status' => 'ok',
                    'message' => 'User not found or not exists',
                ], 200);
        }

        // $client->name = $request->input('name');
        // $client->email = $request->input('email');
        // $client->phone = $request->input('phone');

        // $client->save();

        $client->update($request->all());

        return response()
            ->json(
                [
                    'status' => 'ok',
                    'message' => 'Client success updated info',
                    'data' => $client
                ],
                200
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()
                ->json([
                    'status' => 'ok',
                    'message' => 'User not found or not exists',
                ], 200);
        }

        $client->delete();

        return response()
            ->json(
                [
                    'status' => 'ok',
                    'message' => 'delete successfully',
                ],
                200
            );
    }
}
