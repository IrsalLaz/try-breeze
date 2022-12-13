<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $transactions = DB::table('transactions as t')
                ->select(
                    't.id as id',
                    'u1.fullname as peminjam',
                    'u2.fullname as petugas',
                    't.tanggalPinjam as tanggalPinjam',
                    't.tanggalSelesai as tanggalSelesai',
                )
                ->join('users as u1', 't.userIdPeminjam', '=', 'u1.id')
                ->join('users as u2', 't.userIdPetugas', '=', 'u2.id')
                ->orderBy('tanggalPinjam', 'asc')
                ->get();

            return DataTables::of($transactions)
                ->addColumn(
                    'action',
                    function ($transaction) {
                        $html =
                            '<a href="/transaksiView/' . $transaction->id . '">Edit</a>';

                        return $html;
                    }
                )
                ->make(true);
        }
        return view('transaction.daftarTransaksi');
    }

    // 'dt.id as idTransaksi',
    //             't.tanggalPinjam as tanggalPinjam',
    //             'dt.tanggalKembali as tanggalKembali',
    //             'dt.status as statusType',
    //             DB::raw('
    //                 (CASE
    //                 WHEN dt.status="1" THEN "Pinjam"
    //                 WHEN dt.status="2" THEN "Kembali"
    //                 WHEN dt.status="3" THEN "Hilang"
    //                 END) AS statusP
    //                 '),
    //             'c.namaKoleksi as koleksi'

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        $collections = Collection::where('jumlahSisa', '>', 0)->get();
        return view('transaction.transaksiTambah', compact(
            'collections',
            'users'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate(
            [
                'idPeminjam' => 'required|integer|gt:0',
                'koleksi1' => 'required|integer|gt:0',
            ],
            [
                'idPeminjam.gt' => 'Pilih satu Peminjam',
                'koleksi1.gt' => 'Pilih jenis Item',

            ]
        );

        //membuat 1 objek transaksi dan simpan ke table transactions
        $transaction = new Transaction;
        $transaction->userIdPeminjam = $request->idPeminjam;
        $transaction->userIdPetugas = auth()->user()->id;
        $transaction->tanggalPinjam = Carbon::now()->toDateString();
        $transaction->save();
        $lastTransactionIdStored = $transaction->id;

        // Peminjaman koleksi 1
        $detailTransaksi1 = new DetailTransaction;
        $detailTransaksi1->transactionId = $lastTransactionIdStored;
        $detailTransaksi1->collectionId = $request->koleksi1;
        $detailTransaksi1->status = 1;
        $detailTransaksi1->save();
        DB::table('collections')->where('id', $request->koleksi1)->decrement('jumlahSisa');
        DB::table('collections')->where('id', $request->koleksi1)->increment('jumlahKeluar');

        // Peminjaman koleksi 2
        if ($request->koleksi2 > 0) {
            $detailTransaksi2 = new DetailTransaction;
            $detailTransaksi2->transactionId = $lastTransactionIdStored;
            $detailTransaksi2->collectionId = $request->koleksi2;
            $detailTransaksi2->status = 1;
            $detailTransaksi2->save();
            DB::table('collections')->where('id', $request->koleksi2)->decrement('jumlahSisa');
            DB::table('collections')->where('id', $request->koleksi2)->increment('jumlahKeluar');
        }

        // Peminjaman koleksi 3
        if ($request->koleksi3 > 0) {
            $detailTransaksi3 = new DetailTransaction;
            $detailTransaksi3->transactionId = $lastTransactionIdStored;
            $detailTransaksi3->collectionId = $request->koleksi3;
            $detailTransaksi3->status = 1;
            $detailTransaksi3->save();
            DB::table('collections')->where('id', $request->koleksi3)->decrement('jumlahSisa');
            DB::table('collections')->where('id', $request->koleksi3)->increment('jumlahKeluar');
        }
        return redirect()->route('transaksi')->with('status', 'Peminjaman berhasil');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction, Request $request)
    {
        $transactions = DB::table('transactions as t')
            ->select(
                't.id as id',
                'u1.fullname as fullnamePeminjam',
                'u2.fullname as fullnamePetugas',
                't.tanggalPinjam as tanggalPinjam',
                't.tanggalSelesai as tanggalSelesai',
            )
            ->join('users as u1', 't.userIdPeminjam', '=', 'u1.id')
            ->join('users as u2', 't.userIdPetugas', '=', 'u2.id')
            ->orderBy('tanggalPinjam', 'asc')
            ->where('t.id', '=', $transaction->id)
            ->first();
        return view('transaction.transaksiView', compact('transactions'));
    }

    // return DataTables::of($transactions);
    // ->addColumn(
    //     'action',
    //     function ($transaction) {
    //         $html =
    //             '<a href="/transaksiView/' . $transaction->id . '">Edit</a>';
    //         return $html;
    //     }
    // )
    // ->make(true);

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
