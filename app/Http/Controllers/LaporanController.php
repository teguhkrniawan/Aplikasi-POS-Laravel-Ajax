<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pembelian;
use App\Penjualan;
use App\Pengeluaran;

use PDF;

class LaporanController extends Controller
{
    /**
     * method get data untuk mengambil nilai dari beberapa model
     * seperti model pembelian, penjualan, dan pengeluaran.
     */
    public function getData($awal, $akhir){
        $no = 0;
        $data = array();
        $pendapatan = 0;
        $total_pendapatan = 0;

        /**
         * function strtotime() digunakan untuk mengkonversi strimg ke bentuk time
         *  
         * */ 
        

        // ketika tgl awal lebih kecil dibanding tgl awal lakukan perulangan sebanyak strtotime($akhir)
        while (strtotime($awal) <= strtotime($akhir)) {
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

            // membuat eloquent laravel untuk mendapatkan data total penjualan,  pembelian, pengeluaran
            $total_penjualan = Penjualan::where('created_at', 'LIKE', "$tanggal%") // dimana create_at seperti variabel $tanggal
                               ->sum('bayar'); // totalkan column bayar

            $total_pembelian = Pembelian::where('created_at', 'LIKE', "$tanggal%")
                               ->sum('bayar');

            $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "$tanggal%")
                                 ->sum('nominal');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
            
            // Total pendapatan kan sebelumnya 0 jadi kita tambahkan dengan $pendapatan
            $total_pendapatan += $pendapatan;

            $no++;
            // insialisasikan kedalam array
            $row = array();

            $row[] = $no;
            $row[] = tanggal_indonesia($tanggal, false);
            $row[] = "Rp. " .format_uang($total_penjualan);
            $row[] = "Rp. " .format_uang($total_pembelian);
            $row[] = "Rp. " .format_uang($total_pengeluaran);
            $row[] = "Rp. " .format_uang($pendapatan);

            $data[] = $row;
        }

        $data[] = array(
            "",
            "",
            "",
            "",
            "Total Pendapatan",
            "Rp. ".format_uang($total_pendapatan)
        );

        return $data;
    } 

    /**
     * method index menampilkan view laporan secara awal dari tanggal 1 bulan sekarang
     * hingga tanggal terakhir
     */
    public function index(){
        $awal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y'))); //ambil nilai tanggal 1 - bulan sekarang - tahun sekarang
        $akhir = date('Y-m-d'); // ambil nilai tanggal hari ini

        return view('laporan.index', compact('awal', 'akhir'));
    }

    /**
     * Method listData dipakai untuk manampilkan data ke tabel
     * melalui function ajax pada file ajax
     * 
     * parameternya $awal = tanggal awal yang didapatkan dari indexnya
     * parameternya $akhir = tanggal akhir yang didapatkan dari indexnya
     */
    public function listData($awal, $akhir){

        // variabel data akan menampung nilai return dari method getData()
        $data = $this->getData($awal, $akhir);

        $output = array(
            "data" => $data
        );

        // Jadikan bentuk JSON
        return response()->json($output);
    }

    /**
     * Method exportPDF dipakai untuk membuat tabel-laporan menjadi
     * file dokumen berektensi .pdf
     */
    public function exportPDF($awal,$akhir){
        
        // variabel dibawah ini akan menampung parameter $awal dan $akhir
        $tanggal_awal = $awal;
        $tanggal_akhir = $akhir;

         // variabel data akan menampung nilai return dari method getData()
         $data = $this->getData($awal, $akhir);

         // sintaks dibawah merupakan cara agar bisa meload data dalam bentuk .pdf
         $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
         $pdf = PDF::loadView('laporan.pdf', compact('tanggal_awal', 'tanggal_akhir', 'data'));
         $pdf->setPaper('a4', 'potrait');

         // jadikan bentuk pdf
         return $pdf->stream();
    }

    /**
     * Method refresh berguna untuk merefresh halaman controller laporan
     * setelah user memilih ubah periode tanggal
     */

     public function refresh(Request $request){
         $awal = $request['awal'];
         $akhir = $request['akhir'];

         return view('laporan.index', compact('awal', 'akhir'));
     }

}
