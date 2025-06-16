<?php

namespace App\Http\Controllers;

use App\Models\return_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $return_item = return_item::with(['user', 'item'])->get();
        if (!$return_item->isEmpty()) {
            return response([
                'message' => 'List semua pengembalian',
                'data' => $return_item
            ], 200);
        }
    }

    public function profileIndex()
    {
        $user = Auth::user();
        $return_item = return_item::where('id_user', $user->id)->with(['item'])->get();
        if (!$return_item->isEmpty()) {
            return response([
                'message' => 'List semua pengembalian',
                'data' => $return_item
            ], 200);
        } else {
            return response([
                'message' => 'Tidak ada data pengembalian',
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
            "id_loan" => "required",
            "id_user" => "required",
            "id_item" => "required",
            "return_date" => "required",
            "date_returned" => "required|nullable",
            "quantity" => "required",
            "notes" => "required",
            "condition" => "required",
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
