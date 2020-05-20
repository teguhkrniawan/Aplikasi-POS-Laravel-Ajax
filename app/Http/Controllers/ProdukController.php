<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produk;
use App\Kategori;
use Datatables;
use PDF;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('produk.index', compact('kategori'));
    }

    /**
     * Tampilkan List data.
     *
     * @return \Illuminate\Http\Response
     */
    public function listData()
    {
        $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
                  ->orderBy('produk.id_produk', 'desc')
                  ->get();
        $no = 0;
        $data= array();
    
        foreach ($produk as $list) {
            $no++;
            $row = array();
            $row[] = "<input type='checkbox'>";
            $row[] = $no;
            $row[] = $list->kode_produk;
            $row[] = $list->nama_produk;
            $row[] = $list->nama_kategori;
            $row[] = $list->merk;
            $row[] = "Rp. " .format_uang($list->harga_beli);
            $row[] = "Rp. " .format_uang($list->harga_jual);
            $row[] = $list->diskon ."%";
            $row[] = $list->stok;
            $row[] = '<div class="btn-group">
                    <a onClick="editForm('.$list->id_kategori.')" class="btn btn-primary btn sm">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a onClick="deleteData('.$list->id_kategori.')" class="btn btn-danger btn sm">
                        <i class="fa fa-trash"></i>
                    </a>
                    </div>';
        $data[] = $row;
        }

        return Datatables::of($data)->escapeColumns([])->make(true);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
