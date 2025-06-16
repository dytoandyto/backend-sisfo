<?php

namespace App\Http\Controllers;

use App\Models\loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loan = loan::with(['user', 'item'])->get();
        if (!$loan->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'List semua Peminjaman',
                'data' => $loan
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $loan = Loan::find($id);
        if ($loan) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Peminjaman',
                'data' => $loan
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan',
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
            "id_user" => "required|exists:users,id",
            "id_item" => "required|exists:item_masters,id",
            "date_loan" => "required|date",
            "date_return" => "required|date",
            "quantity" => "required|integer|min:1",
            "status" => "nullable|default:waiting for respond",
        ]);
        $loan = loan::create($validated);
        return response()->json([
            'status' => true,
            'success' => true,
            'message' => 'Peminjaman berhasil dibuat',
            'data' => [$loan],
            // jika ingin detail barang yang dipinjam
            'item' => [
                'id' => $loan->item->id,
                'item_code' => $loan->item->item_code,
                'item_name' => $loan->item->item_name,
                'item_brand' => $loan->item->item_brand,
                'quantity' => $loan->item->quantity,
            ],

        ], 201);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request)
    {
        $request->validate([
            "item_code" => "required",
            "item_name" => "required",
            "item_code" => "required",
            "item_brand" => "required",
            "item_category" => "required",
            "quantity" => "required"
        ]);
        $loan = loan::find($request->id);
        if (!$loan) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan',
                'data' => null
            ]);
        }
        $loan = loan::find($request->id);
        $loan->item_code = $request->item_code;
        $loan->item_name = $request->item_name;
        $loan->item_code = $request->item_code;
        $loan->item_brand = $request->item_brand;
        $loan->item_category = $request->item_category;
        $loan->quantity = $request->quantity;
        $loan->save();
        return response()->json([
            'succes' => true,
            'message' => 'Peminjaman berhasil diupdate',
            'data' => $loan

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(loan $loan, $id)
    {
        $loan = loan::find($id);
        if (!$loan) {
            return response()->json([
                'message' => 'Peminjaman tidak ditemukan',
                'data' => ''
            ]);
        } else {
            $loan->delete();
            return response()->json([
                'message' => 'Peminjaman berhasil dihapus',
                'data' => $loan
            ]);
        }
    }

    public function approve(loan $loan)
    {
        $loan->status = 'approve';
        $loan->save();
        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil di approve',
            'data' => $loan
        ]);
    }

    public function reject(loan $loan)
    {
        $loan->status = 'reject';
        $loan->save();
        return response()->json([
            'success' => true,
            'message' => 'Peminjaman di reject',
            'data' => $loan
        ]);
    }

    public function history(loan $loan, $id)
    {
        $loan = loan::find($id);
        if (!$loan) {
            return response()->json([
                'message' => 'Peminjaman tidak ditemukan',
                'data' => ''
            ]);
        } else {
            return response()->json([
                'message' => 'History Peminjaman',
                'data' => $loan->history
            ]);
        }
    }

    public function HistoryShow(loan $loan, $id)
    {
        $loan = loan::find($id);
        if (!$loan) {
            return response()->json([
                'message' => 'Peminjaman tidak ditemukan',
                'data' => ''
            ]);
        } else {
            return response()->json([
                'message' => 'Detail History Peminjaman',
                'data' => $loan->history
            ]);
        }
    }

    public function HistoryCreate(Request $request)
    {
        $request->validate([
            "item_code" => "required",
            "item_name" => "required",
            "item_code" => "required",
            "item_brand" => "required",
            "item_category" => "required",
            "quantity" => "required"
        ]);
        $loan = loan::find($request->id);
        $loan->item_code = $request->item_code;
        $loan->item_name = $request->item_name;
        $loan->item_code = $request->item_code;
        $loan->item_brand = $request->item_brand;
        $loan->item_category = $request->item_category;
        $loan->quantity = $request->quantity;
        $loan->save();
        return response()->json([
            'succes' => true,
            'message' => 'History Peminjaman berhasil dibuat',
            'data' => $loan
        ]);
    }

    public function HistoryUpdate(Request $request)
    {
        $request->validate([
            "item_code" => "required",
            "item_name" => "required",
            "item_code" => "required",
            "item_brand" => "required",
            "item_category" => "required",
            "quantity" => "required"
        ]);
        $loan = loan::find($request->id);
        $loan->item_code = $request->item_code;
        $loan->item_name = $request->item_name;
        $loan->item_code = $request->item_code;
        $loan->item_brand = $request->item_brand;
        $loan->item_category = $request->item_category;
        $loan->quantity = $request->quantity;
        $loan->save();
        return response()->json([
            'success' => true,
            'message' => 'History Peminjaman berhasil diupdate',
            'data' => $loan
        ]);
    }

    public function HistoryDestroy(loan $loan, $id)
    {
        $loan = loan::find($id);
        if (!$loan) {
            return response()->json([
                'message' => 'History Peminjaman tidak ditemukan',
                'data' => ''
            ]);
        }
    }

    public function showUserLoans()
    {
        $user = Auth::user();
        $loans = loan::where('id_user', $user->id)->with(['item'])->get();
        if (!$loans->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'List Peminjaman Anda',
                'data' => $loans
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum melakukan peminjaman',
                'data' => []
            ]);
        }
    }

    public function notification()
    {
        $loans = loan::where('status', 'approve')->get();
        if (!$loans->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Peminjaman yang sudah di approve, Silahkan ambil barangnya',
                'data' => $loans
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada Peminjaman yang sudah di approve',
                'data' => []
            ]);
        }
    }
    public function notificationRejected()
    {
        $loans = loan::where('status', 'reject')->get();
        if (!$loans->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Peminjaman anda di reject oleh admin',
                'data' => $loans
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada Peminjaman yang sudah di reject',
                'data' => []
            ]);
        }
    }
}
