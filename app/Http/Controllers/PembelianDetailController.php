<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\Pembelian;
use App\Supplier;
use App\Produk;
use App\PembelianDetail;

class PembelianDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        
        $idpembelian = session('idpembelian');
        $supplier = Supplier::find(session('idsupplier'));

        return view('pembelian_detail.index', compact('produk', 'idpembelian', 'supplier'));
    }

    /**
     * Listdata dari keranjang, kenapa ada id_pembelian ? karena sesuai dengan
     * detail yang akan dimasukkan dalam keranjang
     *
     * @return \Illuminate\Http\Response
     */
    public function listData($id)
    {
        $detail = PembelianDetail::leftJoin('produk','produk.kode_produk', '=', 'pembelian_detail.kode_produk')
                  ->where('id_pembelian', '=', $id)
                  ->get();

        $no = 0;
        $data = array();
        $total = 0;
        $total_item = 0;
        //$stok_baru = 0;
        $produkID = 0;


        foreach ($detail as $list) {
            $no++;
            //$stok_baru = $list->stok;
            $produkID = $list->id_produk;
            $row = array();
            $row[] = "<input type='hidden' class='form-control'              
                        name='produk_$list->id_produk' id='produk_id' value='$list->id_produk'>";
            $row[] = $no;
            $row[] = $list->kode_produk;
            $row[] = $list->nama_produk;
            $row[] = "Rp." .format_uang($list->harga_beli);
            $row[] = "<input type='number' class='form-control'              
                      name='jumlah_$list->id_pembelian_detail' value='$list->jumlah' 
                      onChange='changeCount($list->id_pembelian_detail, $list->id_produk)'>";
            $row[] = "Rp." .format_uang($list->harga_beli * $list->jumlah);
            $row[] = "<a onClick='deleteItem($list->id_pembelian_detail)' class='btn btn-sm btn-danger'>
                      <i class='fa fa-trash'></i>
                      </a>";


            $data[] = $row;

            $total += $list->harga_beli * $list->jumlah;
            $total_item += $list->jumlah;
            //$stok_baru += $list->jumlah;
        }

        // TODO : Span kotak total bayar
        $data[] = array
        ("<span class='hide total'>$total</span>",
         "<span class='hide totalitem'>$total_item</span>", 
         "<input type='hidden' name='produkID' id='produkID' value='$produkID'></input>", "", "" ,"", "", "");

        // output data
        $output = array("data" => $data);
        return response()->json($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = Produk::where('kode_produk', '=', $request['kode'])->first();
        
        $detail = new PembelianDetail;
        $detail->id_pembelian = $request['idpembelian'];
        $detail->kode_produk = $request['kode'];
        $detail->harga_beli = $produk->harga_beli;
        $detail->jumlah = 1;
        $detail->sub_total = $produk->harga_beli;
        $detail->save();

        // untuk menambahkan 1 ke stok
        // $updateStok = Produk::find($request['id']);
        // $updateStok->stok += 1;
        // $updateStok->update();
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
     * Method ini berfungsi untuk mengubah ke db (tb_detail_pembelian)
     * ketika ada event yang dilakukan pada input text jumlah atau diskon
     * 
     */
    public function update(Request $request, $id)
    {
       
        $nama_input = "jumlah_".$id;
       
        $detail = PembelianDetail::find($id);
        
        // ini mengupdate nilai column jumlah dan subtotal berdasarkan ID pembelian detail pada record yg dituju
        $detail->jumlah = $request[$nama_input];
        $detail->sub_total = $detail->harga_beli * $request[$nama_input];
        $detail->update();

        // panggil data produk yang column kode_produk = input name nya kode
        $produk = Produk::where('kode_produk', '=', $request['kode'])->first();
        // produk 1 = id dari record diatas
        $produk1 = Produk::find($produk->id_produk);
        // tambahkan jumlah stok dari input type tersebur
        $produk1->stok += $request[$nama_input];
        $produk1->update();

        // TODO 
        /**
         * method ini masih ada bug
         * ketika user mau mengganti jumlah item produk lainnya pasti error
         * hal itu terjadi karena line 152. sintaks tersebut mengambil referensi dari input name kode
         * 
         * solusi nya :
         * buat script js onClick di input jumlah 
         * dimana ketika user klik input jumlah, input kode akan berubah sesuai kode produknya.
         */

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = PembelianDetail::find($id);
        $detail->delete();
    }

     // method perhitungan diskon dan konversi angka ke tulisan
     public function loadForm($diskon, $total){
        $bayar = $total  - ($diskon/100 * $total);
        $data = array(
            "totalrp" => format_uang($total),
            "bayar"   => $bayar,
            "bayarrp" => format_uang($bayar),
            "terbilang" => ucwords(terbilang($bayar)). " Rupiah"
        );
        return response()->json($data);
    }

}
