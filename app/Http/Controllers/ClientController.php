<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // checa se o usuario tem permissões para acessar
        if (!auth()->user()->tokenCan('clients:list')) {
            return ApiResponse::unauthrized();
        }

        // retorna todos os clientes da base de dados
        // return response()
        //     ->json(
        //         Client::paginate(10),
        //         200
        //     );
        return ApiResponse::success(Client::paginate(10));
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

        // return response()
        //     ->json([
        //         'message' => 'Client created successfully',
        //         'data' => $client
        //     ]);

        return ApiResponse::success($client);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        if (!auth()->user()->tokenCan('clients:detail')) {
            return ApiResponse::unauthrized();
        }
        
        $client = Client::find($id);

        if (!$client) {
            // return response()
            //     ->json([
            //         'status' => 'ok',
            //         'message' => 'User not found or not exists',
            //     ], 200);
            return ApiResponse::error('Client not found');
        }

        // return response()
        //     ->json(
        //         [
        //             'status' => 'ok',
        //             'message' => 'success',
        //             'data' => $client
        //         ],
        //         200
        //     );
        return ApiResponse::success($client);
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
            // return response()
            //     ->json([
            //         'status' => 'ok',
            //         'message' => 'User not found or not exists',
            //     ], 200);
            return ApiResponse::error('Client not found');
        }

        // $client->name = $request->input('name');
        // $client->email = $request->input('email');
        // $client->phone = $request->input('phone');

        // $client->save();

        $client->update($request->all());

        // return response()
        //     ->json(
        //         [
        //             'status' => 'ok',
        //             'message' => 'Client success updated info',
        //             'data' => $client
        //         ],
        //         200
        //     );
        return ApiResponse::success($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);

        if (!$client) {
            // return response()
            //     ->json([
            //         'status' => 'ok',
            //         'message' => 'User not found or not exists',
            //     ], 200);
            return ApiResponse::error('Client not found');
        }

        $client->delete();

        // return response()
        //     ->json(
        //         [
        //             'status' => 'ok',
        //             'message' => 'delete successfully',
        //         ],
        //         200
        //     );
        return ApiResponse::success('delete successfully');
    }
}
