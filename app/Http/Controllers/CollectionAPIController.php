<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\Collection as CollectionResource;
use App\Models\Collection;
use Illuminate\Support\Facades\Validator;

class CollectionAPIController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::all();
        return $this->sendResponse(
            CollectionResource::collection($collections),
            'Posts fetched'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'namaKoleksi' => 'required',
            'jenisKoleksi' => 'required',
            'jumlahAwal' => 'required',
            'jumlahSisa' => 'required',
            'jumlahKeluar' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $collection = Collection::create($input);
        return $this->sendResponse(new CollectionResource($collection), 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collection =  Collection::find($id);
        if (is_null($collection)) {
            return $this->sendError('Post does not exits.');
        }
        return $this->sendResponse(new CollectionResource($collection), 'Post fetched');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'namaKoleksi' => 'required',
            'jenisKoleksi' => 'required',
            'jumlahAwal' => 'required',
            'jumlahSisa' => 'required',
            'jumlahKeluar' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $collection->namaKoleksi = $input['namaKoleksi'];
        $collection->jenisKoleksi = $input['jenisKoleksi'];
        $collection->jumlahAwal = $input['jumlahAwal'];
        $collection->jumlahSisa = $input['jumlahSisa'];
        $collection->jumlahKeluar = $input['jumlahKeluar'];
        $collection->save();

        return $this->sendResponse(new CollectionResource($collection), 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return $this->sendResponse([], 'Post deleted');
    }
}
