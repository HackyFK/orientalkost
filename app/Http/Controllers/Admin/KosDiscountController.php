<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\KosDiscount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KosDiscountController extends Controller
{

    public function index()
    {
        $discounts = KosDiscount::with('kos')

            ->when(Auth::user()->role == 'owner', function ($query) {
                $query->whereHas('kos', function ($q) {
                    $q->where('owner_id', Auth::id());
                });
            })

            ->latest()
            ->paginate(10);

        return view('admin.discounts.index', compact('discounts'));
    }


    public function create()
    {
        if (Auth::user()->role == 'admin') {
            $kos = Kos::all();
        } else {
            $kos = Kos::where('owner_id', Auth::id())->get();
        }

        return view('admin.discounts.create', compact('kos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kos_id' => 'required|exists:kos,id',
            'nama' => 'required|string|max:255',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:1',
            'max_discount' => 'nullable|numeric|min:0',

            'min_durasi' => 'nullable|integer|min:1',
            'min_total' => 'nullable|numeric|min:0',

            'jenis_sewa' => 'nullable|in:harian,bulanan,tahunan',

            'days' => 'nullable|array',
            'days.*' => 'in:mon,tue,wed,thu,fri,sat,sun',

            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',

            'is_active' => 'nullable|boolean'
        ]);

        KosDiscount::create([
            'kos_id' => $request->kos_id,
            'nama' => $request->nama,
            'type' => $request->type,
            'value' => $request->value,
            'max_discount' => $request->max_discount,

            'min_durasi' => $request->min_durasi,
            'min_total' => $request->min_total,

            'jenis_sewa' => $request->jenis_sewa,

            'days' => $request->days,

            'start_date' => $request->start_date,
            'end_date' => $request->end_date,

            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.kos-discounts.index')
            ->with('success', 'Diskon berhasil dibuat');
    }


    public function edit(KosDiscount $kosDiscount)
    {
        $this->authorizeOwner($kosDiscount);

        if (Auth::user()->role == 'admin') {
            $kos = Kos::all();
        } else {
            $kos = Kos::where('owner_id', Auth::id())->get();
        }

        return view('admin.discounts.edit', compact('kosDiscount', 'kos'));
    }


    public function update(Request $request, KosDiscount $kosDiscount)
    {
        $this->authorizeOwner($kosDiscount);

        $request->validate([
            'nama' => 'required|string|max:255',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:1',
            'max_discount' => 'nullable|numeric|min:0',

            'min_durasi' => 'nullable|integer|min:1',
            'min_total' => 'nullable|numeric|min:0',

            'jenis_sewa' => 'nullable|in:harian,bulanan,tahunan',

            'days' => 'nullable|array',
            'days.*' => 'in:mon,tue,wed,thu,fri,sat,sun',

            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',

            'is_active' => 'nullable|boolean'
        ]);

        $kosDiscount->update([
            'nama' => $request->nama,
            'type' => $request->type,
            'value' => $request->value,
            'max_discount' => $request->max_discount,


            'min_durasi' => $request->min_durasi,
            'min_total' => $request->min_total,

            'jenis_sewa' => $request->jenis_sewa,

            'days' => $request->days,

            'start_date' => $request->start_date,
            'end_date' => $request->end_date,

            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.kos-discounts.index')
            ->with('success', 'Diskon berhasil diperbarui');
    }


    public function destroy(KosDiscount $kosDiscount)
    {
        $this->authorizeOwner($kosDiscount);

        $kosDiscount->delete();

        return back()->with('success', 'Diskon berhasil dihapus');
    }


    private function authorizeOwner($discount)
    {
        if (
            Auth::user()->role == 'owner' &&
            $discount->kos->owner_id != Auth::id()
        ) {
            abort(403);
        }
    }
}
