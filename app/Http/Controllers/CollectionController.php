<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

// use DataTables;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // dd($request);
        if ($request->ajax()) {
            $collections = DB::table('collections')
                ->select(
                    'id as id',
                    'namaKoleksi as namaKoleksi',
                    'jumlahKoleksi as jumlahKoleksi'
                )->get();
            return Datatables::of($collections)->make(true);
        }
        return view('koleksi.daftarKoleksi');
    }

    // public function getKoleksi(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Collection::latest()->get();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function ($collection) {
    //                 $actionBtn = '
    //                 <button data-rowid="" class=" btn btn-xs btn-light" data-toggle="tooltip" data-placement="top" data-container="body" title="Edit Koleksi" onclick="infoKoleksi(' . "'" . $collection->id . "'" . ')">
    //                 <i class="fa fa-edit>></i>
    //                 ';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('koleksi.registrasi');
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
        $validated = $request->validate(
            [
                'namaKoleksi' => ['required', 'string', 'max:100'],
                'jenisKoleksi' => ['required', 'integer'],
                'jumlahKoleksi' => ['required', 'integer']
            ]
        );
        Collection::create($validated);
        return redirect('koleksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\collections  $collections
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('koleksi.infoKoleksi');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\collections  $collections
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\collections  $collections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\collections  $collections
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
