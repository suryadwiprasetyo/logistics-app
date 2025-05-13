<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $end = now()->startOfMonth();
        $start = $end->copy()->subYear(3); // ambil 3 tahun ke belakang

        if (in_array(Auth::user()->role, ['admin', 'super'])) {
            $shipments = Shipment::whereBetween('date', [$start, $end])
                ->orderBy('date', 'desc')
                ->get();
        } else {
            $shipments = Shipment::where('user_id', Auth::id())
                ->whereBetween('date', [$start, $end])
                ->orderBy('date', 'desc')
                ->get();
        }

        return view('shipments.index', compact('shipments'));
    }

    public function create()
    {
        if (!in_array(Auth::user()->role, ['admin', 'super'])) {
            abort(403, 'Kamu tidak punya izin.');
        }

        $users = User::where('role', 'user')->get();

        return view('shipments.create', compact('users'));
    }

    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'super'])) {
            abort(403, 'Kamu tidak punya izin.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'invoice' => 'required|string',
            'cwb' => 'required|string',
            'origin' => 'required|string',
            'destination' => 'required|string',
            'date' => 'required|date',
            'customer_id' => 'required|string',
            'company_name' => 'required|string',
            'receiver_name' => 'required|string',
            'type' => 'required|string',
            'qty' => 'required|integer',
            'weight' => 'required|numeric',
            'subtotal' => 'required|numeric',
        ]);

        Shipment::create($request->all());

        return redirect()->route('shipments.index')->with('success', 'Data kiriman berhasil ditambahkan.');
    }

    public function exportCsv()
    {
        $filename = 'shipments_' . now()->format('Ymd_His') . '.csv';

        $end = now()->startOfMonth();
        $start = $end->copy()->subYear(3);

        if (in_array(Auth::user()->role, ['admin', 'super'])) {
            $shipments = Shipment::whereBetween('date', [$start, $end])->get();
        } else {
            $shipments = Shipment::where('user_id', Auth::id())
                ->whereBetween('date', [$start, $end])
                ->get();
        }

        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $columns = [
            'invoice',
            'cwb',
            'origin',
            'destination',
            'date',
            'customer_id',
            'company_name',
            'receiver_name',
            'type',
            'qty',
            'weight',
            'subtotal',
        ];

        $callback = function () use ($shipments, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($shipments as $shipment) {
                fputcsv($file, $shipment->only($columns));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
