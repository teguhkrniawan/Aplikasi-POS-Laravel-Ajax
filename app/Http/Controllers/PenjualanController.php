<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\Penjualan;
use App\Produk;
use App\Member;
use App\PenjualanDetail;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penjualan.index');
    }

    /**
     * Method ini digunakan untuk menampilkan data dari
     * database tb_penjualan ke tabel penjualan di index
     *
     */
    public function listData()
    {
        /**
         * Lakukan left JOIN pada tb_user dan tb_penjualan
         * kenapa melakukan left JOIN ?
         * karena kita akan menampilkan data penjualan yang dilayani oleh kasir
         * data kasir (ect: nama) bisa kita peroleh dari tb_user
         */

         $penjualan = Penjualan::leftJoin('users', 'users.id', '=', 'penjualan.id_user')
                      ->select('users.*', 'penjualan.*', 'penjualan.created_at as tanggal')
                      ->orderBy('penjualan.id_penjualan', 'desc')
                      ->get();
         
        $no = 0;

        // tampung data pada variabel Array
        $data = array();

        // lakukan perulangan dari hasil $penjualan
        foreach ($penjualan as $list) {
            
            $no++;

            // tampung baris per record dalam array
            $row = array();
            $row[] = $no;
            $row[] = tanggal_indonesia(substr($list->tanggal, 0, 10), false);
            $row[] = $list->kode_member;
            $row[] = $list->total_item;
            $row[] = "Rp. " .format_uang($list->total_harga);
            $row[] = $list->diskon ."%";
            $row[] = "Rp. " .format_uang($list->bayar);
            $row[] = $list->name;
            $row[] = '<div class="btn-group">
                        <a onClick="showDetail('.$list->id_penjualan.')" class="btn btn-primary btn sm">
                            <i class="fa fa-eye"></i>
                        </a>
                        </div>';
                        
                        // <a onClick="deleteData('.$list->id_penjualan.')" class="btn btn-danger btn sm">
                        //     <i class="fa fa-trash"></i>
                        // </a>
                        
            // masukkan $row kedalam $data
            $data[] = $row;
        }

        // buat ouputnya dalam bentuk JSON agar ajax menerima
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
        //
    }

    /**
     * Method ketika user mengklik icon mata
     * ini adalah method detail
     */
    public function show($id)
    {
        /**
         * Lakukan left JOIN pada tb_produk dan penjualan detail
         * karena tampilan dari tabelnya akan membutuhkan data produk
         * seperti kode produk
         */

         $detail = PenjualanDetail::leftJoin('produk', 'produk.kode_produk', '=', 'penjualan_detail.kode_produk')
                   ->where('id_penjualan', '=', $id)
                   ->get();

         $no = 0;

         // tampung dalam variabale arrat
         $data = array();

         // lakukan perulangand dari variabel $detail
         foreach ($detail as $list) {
             
            $no++;
            // tampung record pada variabel $row
            $row = array();
            $row[] = $no;
            $row[] = $list->kode_produk;
            $row[] = $list->nama_produk;
            $row[] = "Rp. " .format_uang($list->harga_jual);
            $row[] = $list->jumlah;
            $row[] = "Rp. " .format_uang($list->sub_total);

            $data[] = $row;

         }

         // jadikan JSON agar dibaca oleh ajax
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
