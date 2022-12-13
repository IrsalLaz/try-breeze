<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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
                    DB::raw('
                    (CASE
                    WHEN jenisKoleksi="1" THEN "Buku"
                    WHEN jenisKoleksi="2" THEN "Majalah"
                    WHEN jenisKoleksi="3" THEN "Cakram Digital"
                    END) AS jenis
                    '),
                    'jumlahSisa as jumlahSisa',
                )->get();
            return Datatables::of($collections)
                ->addColumn(
                    'action',
                    function ($collections) {
                        $html =
                            '<a href="/koleksiView/' . $collections->id . '">Edit</a>';
                        return $html;
                    }
                )
                ->make(true);
        }
        return view('koleksi.daftarKoleksi');
    }

    public function getCollectionsAPI()
    {
        $collections = Collection::all();
        return response()->json($collections, 200);
    }

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
                'jumlahSisa' => ['required', 'integer']
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
    public function show(Collection $collection)
    {
        return view('koleksi.infoKoleksi', compact('collection'));
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
    public function update(Request $request, $id)
    {
        // dd($request);
        $validated = $request->validate([
            'jenisKoleksi' => ['required', 'integer'],
            'jumlahSisa' => ['required', 'integer']
        ]);

        Collection::find($id)->update($validated);

        return redirect('/koleksi');
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
