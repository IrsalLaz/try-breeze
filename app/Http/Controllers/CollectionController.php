<?php

namespace App\Http\Controllers;

use App\Models\collections;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('koleksi.daftarKoleksi');
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
        return view('koleksi.daftarKoleksi');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\collections  $collections
     * @return \Illuminate\Http\Response
     */
    public function show(collections $collections)
    {
        return view('koleksi.infoKoleksi');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\collections  $collections
     * @return \Illuminate\Http\Response
     */
    public function edit(collections $collections)
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
    public function update(Request $request, collections $collections)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\collections  $collections
     * @return \Illuminate\Http\Response
     */
    public function destroy(collections $collections)
    {
        //
    }
}
