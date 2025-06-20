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
        $item_master = item_master::with('category')->get()->map(function ($item) {
            $item->image = $item->image ? asset('storage/' . $item->image) : null;
            // Ganti item_category dengan nama kategori
            $item->item_category = $item->category ? $item->category->name_category : null;
            unset($item->category); // opsional, agar relasi tidak ikut di response
            return $item;
        });
        return response()->json([
            'data' => $item_master
        ]);
    }

    public function show($id)
    {
        $item_master = item_master::with('category')->find($id);
        if ($item_master) {
            $item_master->image = $item_master->image ? asset('storage/' . $item_master->image) : null;
            // Ganti item_category dengan nama kategori
            $item_master->item_category = $item_master->category ? $item_master->category->name_category : null;
            unset($item_master->category); // opsional, agar relasi tidak ikut di response
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
        $validated = $request->validate([
            "item_code" => "required|unique:item_master",
            "item_name" => "required",
            "item_code" => "required",
            "item_brand" => "required",
            "item_category" => "required",
            "quantity" => "required",
            "image" => "required"
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }
        $item_master = item_master::create($validated);

        // Tambahkan URL gambar pada response
        $item_master->image = $item_master->image ? asset('storage/' . $item_master->image) : null;

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil dibuat',
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

        $item_master = item_master::with('category')->findOrFail($id);
        $item_master->item_code = $request->item_code;
        $item_master->item_name = $request->item_name;
        $item_master->item_code = $request->item_code;
        $item_master->item_brand = $request->item_brand;
        $item_master->item_category = $request->item_category;
        $item_master->quantity = $request->quantity;

        // Handle upload gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $item_master->image = $imagePath;
        } else {
            // Jika tidak ada gambar baru, tetap simpan gambar lama
            $item_master->image = $item_master->image ? $item_master->image : null;
        }
        // Simpan perubahan
        // $item_master->item_category = $item_master->category ? $item_master->category->name_category : null;
        unset($item_master->category); // opsional, agar rel
        $item_master->save();

        // Tambahkan url gambar dan kategori string pada response
        $item_master->image = $item_master->image ? asset('storage/' . $item_master->image) : null;
        $item_master->item_category = $item_master->category ? $item_master->category->name_category : $item_master->item_category;
        unset($item_master->category);

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil diupdate',
            'data' => $item_master
        ], 200);
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
