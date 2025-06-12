<?php

namespace App\Http\Controllers;

use App\Models\return_item;
use Illuminate\Http\Request;

class ReturnItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $return_item = return_item::all();
        if (!$return_item->isEmpty()) {
            return response([
                'message' => 'List semua pengembalian',
                'data' => $return_item
            ], 200);
        } else {
            return response([
                'message' => 'Data pengembalian tidak ditemukan',
                'data' => null
            ], 404);
        }
    }

    public function show(return_item $return_item)
    {
        $return_item = return_item::find($return_item);
        if ($return_item) {
            return response([
                'message' => 'Detail pengembalian',
                'data' => $return_item
            ], 200);
        } else {
            return response([
                'message' => 'Data pengembalian tidak ditemukan',
                'data' => null
            ], 404);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            "id_loan" => "",
            "id_user" => "",
            "id_item" => "",
            "return_date" => "",
            "quantity" => "",
            "note" => "",
            "condition" => "",
        ]);
        $return_item = return_item::create($validated);
        if ($return_item) {
            return response([
                'message' => 'Pengembalian berhasil dibuat',
                'data' => $return_item
            ], 201);
        } else {
            return response([
                'message' => 'Pengembalian gagal dibuat',
                'data' => null
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(return_item $return_item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, return_item $return_item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(return_item $return_item)
    {
        //
    }
}
