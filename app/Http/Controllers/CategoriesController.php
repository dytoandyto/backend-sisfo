<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menampilkan semua category
        $categories = categories::all();
        return response()->json($categories);
        if ($categories) {
            return response()->json([
                'success' => true,
                'message' => 'List Semua Category',
                'data' => $categories
            ], 200);
        }
    }
    public function show($id)
    {
        // menampilkan category berdasarkan id
        $categories = categories::find($id);
        if ($categories) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Category',
                'data' => $categories
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //membuat category baru
        $validated = $request->validate([
            "   " => "required",
            "description" => "required"
        ]);
        $categories = categories::create($validated);
        return response()->json([
           'success' => true,
           'message' => 'Category berhasil ditambahkan',
            'data' => $categories
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name_category" => "required",
            "description" => "required"
        ]);

        $categories = categories::findOrFail($id);
        $categories->name_category = $request->name_category;
        $categories->description = $request->description;
        $categories->save();
        return response()->json([
            'success' => true,
            'message' => 'Category berhasil diupdate',
            'data' => $categories
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categories $categories, $id)
    {
        // menghapus
        $categories = categories::findOrFail($id);
        $categories->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category berhasil dihapus',
            'data' => $categories
        ]);
    }
}
