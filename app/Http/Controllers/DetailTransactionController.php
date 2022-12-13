<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DetailTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $transactionId)
    {
        return view('detailTransaction.detailTransactionKembalikan', compact('detail_transactions'));
    }

    public function getAllDetailTransactions($transactionId)
    {
        $detail_transactions = DB::table('detail_transactions as dt')
            ->select(
                'dt.id as id',
                'c.namaKoleksi as koleksi',
                't.tanggalPinjam as tanggalPinjam',
                'dt.tanggalKembali as tanggalKembali',
                DB::raw('
                (CASE
                WHEN dt.status="1" THEN "Pinjam"
                WHEN dt.status="2" THEN "Kembali"
                WHEN dt.status="3" THEN "Hilang"
                END) as status
                '),
                'dt.status as statusType',
            )
            ->join('collections as c', 'c.id', '=', 'dt.collectionId')
            ->join('transactions as t', 't.id', '=', 'dt.transactionId')
            ->where('transactionId', '=', $transactionId)->get();

        return DataTables::of($detail_transactions)
            ->addColumn(
                'action',
                function ($detail_transaction) {
                    $html =
                        '<a href="/detailTransactionKembalikan/' . $detail_transaction->id . '">Edit</a>';

                    return $html;
                }
            )
            ->make(true);
    }

    public function detailTransactionKembalikan($detailTransactionId)
    {
        $detailTransaction = DB::table('detail_transactions as dt')
            ->select(
                't.id as idTransaksi',
                'dt.id as id',
                'dt.tanggalKembali as tanggalKembali',
                't.tanggalPinjam as tanggalPinjam',
                'dt.status',
                'u1.fullname as peminjam',
                'u2.fullname as petugas',
                'c.namaKoleksi as koleksi'
            )
            ->join('collections as c', 'c.id', '=', 'dt.collectionId')
            ->join('transactions as t', 't.id', '=', 'dt.transactionId')
            ->join('users as u1', 't.userIdPeminjam', '=', 'u1.id')
            ->join('users as u2', 't.userIdPetugas', '=', 'u2.id')
            ->where('dt.id', '=', $detailTransactionId)->first();

        return view('detailTransaction.detailTransactionKembalikan', compact('detailTransaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(DetailTransaction $detailTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailTransaction $detailTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->status == 1) {
        } else {
            $affected = DB::table('detail_transactions')
                ->where('id', $request->idDetailTransaksi)
                ->update([
                    'status' => $request->status,
                    'tanggalKembali' => Carbon::now()->toDateString()
                ]);
            if ($request->status == 2) {
                // DiKembalikan
                DB::table('collections')->increment('jumlahSisa');
                DB::table('collections')->decrement('jumlahKeluar');
            } else {
                // Hilang
                DB::table('collections')->increment('jumlahSisa');
            }
        }
        $transaction = Transaction::where('id', '=', $request->idTransaksi)->first();
        return redirect('transaksiView/' . $request->idTransaksi)->with('transaction', $transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailTransaction  $detailTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailTransaction $detailTransaction)
    {
        //
    }
}
