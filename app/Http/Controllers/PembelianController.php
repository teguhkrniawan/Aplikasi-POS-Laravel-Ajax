<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\Pembelian;
use App\Supplier;
use App\PembelianDetail;
use App\Produk;

class PembelianController extends Controller
{
    /**
     * Menampilkan view pembelian
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return view('pembelian.index', compact('supplier'));
    }

    /**
     * Gunakan leftJoin untuk merelasikan tb_supplier dan tb_pembelian
     * pembelian.created_at diberi alias agar tidak bertabrakan dengan kolom created_at pada tb_supplier
     * supplier.nama juga diberi alias agar terbaca(fetch) oleh sistem
     */

    public function listData(){
        $pembelian = Pembelian::leftJoin('supplier', 'supplier.id_supplier', '=', 'pembelian.id_supplier')
                    ->select('pembelian.*', 'pembelian.created_at as tanggal', 'supplier.nama as nama')
                    ->orderBy('pembelian.id_pembelian', 'desc')
                    ->get();
        $no = 0;
        $data= array();
       
        foreach ($pembelian as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = tanggal_indonesia(substr($list->tanggal, 0, 10), false);
            //$row[] = date("Y-m-d H:i:s", $list->created_at);
            $row[] = $list->nama;
            $row[] = $list->total_item;
            $row[] = "Rp. ".format_uang($list->total_harga);
            $row[] = $list->diskon ."%";
            $row[] = "Rp. ".format_uang($list->bayar);
            $row[] = '<div class="btn-group">
                       <a onClick="showDetail('.$list->id_pembelian.')" class="btn btn-primary btn sm">
                           <i class="fa fa-eye"></i>
                       </a>
                       <a onClick="deleteData('.$list->id_pembelian.')" class="btn btn-danger btn sm">
                           <i class="fa fa-trash"></i>
                       </a>
                     </div>';
           $data[] = $row;

        }

        $output = array("data" => $data);

        return response()->json($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pembelian = new Pembelian;
        $pembelian->id_supplier = $id;
        $pembelian->total_item = 0;
        $pembelian->total_harga = 0;
        $pembelian->diskon = 0;
        $pembelian->bayar = 0;
        $pembelian->save();

        session(['idpembelian' => $pembelian->id_pembelian]);
        session(['idsupplier' => $id]);

        return Redirect::route('pembelian_detail.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pembelian = Pembelian::find($request['idpembelian']);
        $pembelian->total_item = $request['totalitem'];
        $pembelian->total_harga = $request['total'];
        $pembelian->diskon = $request['diskon'];
        $pembelian->bayar = $request['bayar'];
        $pembelian->update();

        return Redirect::route('pembelian.index');
        
    }

    /**
     * method menampilkan detail pembelian
     *
     */
    public function show($id)
    {
       $detail = PembelianDetail::leftJoin('produk', 'produk.kode_produk', '=', 'pembelian_detail.kode_produk')
                 ->select('pembelian_detail.*', 'pembelian_detail.harga_beli as harga', 'produk.nama_produk as nama')
                 ->where('id_pembelian', '=', $id)
                 ->get();

        $no = 0;
        $data= array();
    
        foreach ($detail as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->kode_produk;
            $row[] = $list->nama;
            $row[] = "Rp. ".format_uang($list->harga);
            $row[] = $list->jumlah;
            $row[] = "Rp. ".format_uang($list->harga * $list->jumlah);
            
            $data[] = $row;
        }

        $output = array("data" => $data);

        return response()->json($output);

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
        $nama_input = "jumlah_".$id;
        $detail->id_pembelian = $request['idpembelian'];
        $detail->kode_produk = $request['kode'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembelian = Pembelian::find($id);
        $pembelian->delete();

        $detail = PembelianDetail::where('id_pembelian', '=', $id)
                  ->get();
        foreach ($detail as $data) {
            // $produk = Produk::where('kode_produk', '=', $data->kode_produk)->first();
            // $produk->stok -= $data->jumlah;
            // $produk->update();
            $data->delete();
        }
    }
}
