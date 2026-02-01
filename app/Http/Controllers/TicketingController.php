<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use function Symfony\Component\Clock\now;

class TicketingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Riwayat::with('user', 'keluhan')
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('umum.ticketing.ticket', [
            'title' => 'List Ticket'
        ], compact('tickets'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $tiket = Riwayat::with('keluhan')->findOrFail($id);

        /** ===========IT=============== */
        if(auth()->user()->hasRole('it')){

            //request
            $request->validate([
                'status' => 'required|in:pending,rejected,proses,done',
                'action' => 'required|in:create,rejected,approved,proses,update,delete',
                'catatan' => 'nullable|string'
            ]);
            $tiket->update([
                'status' => $request->status,
                'action' => $request->action,
                'catatan' => $request->catatan,
                'handled_by' => auth()->id(),
            ]);
            Alert::success('Success', 'Riwayat berhasil diupdate Tim IT');
            return redirect()->back();
        }

        /**  ==============MANAGER IT=============== */
        if(auth()->user()->hasRole('manager')){

            $request->validate([
                'status' => 'required|in:open,done',
            ]);

            $data = [
                'status' => $request->status,
                'acc_by' => auth()->id(),
            ];
            if($request->status == "done"){
                $data['tgl_selesai'] = now();
            }
            $tiket->keluhan->update($data);

            Alert::success('Success', 'Keluhan berhasil diselesaikan Manager');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
