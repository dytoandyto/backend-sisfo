<?php

namespace App\Http\Controllers;

use App\Models\item_master;
use Illuminate\Http\Request;

class ItemMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item_master = item_master::all();
        return response()->json($item_master);
        if ($item_master) {
            return response()->json([
                'message' => 'List semua Item',
                'data' => $item_master
            ]);
        }
    }

    public function show($id)
    {
        //menampilkan item berdasarkan id
        $item_master = item_master::find($id);
        if ($item_master) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Item',
                'data' => $item_master
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //membuat item baru
        $validated = $request->validate([
            "item_code" => "required|unique:item_master",
            "item_name" => "required",
            "item_code" => "required",
            "item_brand" => "required",
            "item_category" => "required",
            "quantity" => "required"
        ]);
        $item_master = item_master::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Item  berhasil dibuat',
            'data' => $item_master
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        //mencari item berdasarkan id
        $item_master = item_master::find($id);
        if (!$item_master) {
            return response()->json([
                'message' => 'Item tidak ditemukan',
                'data' => ''
            ]);
        } else {
            return response()->json([
                'message' => 'Detail Item',
                'data' => $item_master
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "item_code" => "required|unique:item_master",
            "item_name" => "required",
            "item_code" => "required",
            "item_brand" => "required",
            "item_category" => "required",
            "quantity" => "required"
        ]);

        $item_master = item_master::findOrFail($id);
        $item_master->item_code = $request->item_code;
        $item_master->item_name = $request->item_name;
        $item_master->item_code = $request->item_code;
        $item_master->item_brand = $request->item_brand;
        $item_master->item_category = $request->item_category;
        $item_master->quantity = $request->quantity;
        $item_master->save();
        return response()->json([
            'success' => true,
            'message' => 'Item berhasil diupdate',
            'data' => $item_master
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(item_master $item_master, $id)
    {
        $item_master = item_master::find($id);
        if (!$item_master) {
            return response()->json([
                'message' => 'Item tidak ditemukan',
                'data' => ''
            ]);
        } else {
            $item_master->delete();
            return response()->json([
                'message' => 'Item berhasil dihapus',
                'data' => $item_master
            ]);
        }
    }
}
