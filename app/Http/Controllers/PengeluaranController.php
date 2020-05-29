<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengeluaran;
use Datatables;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengeluaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listData()
    {
        $pengeluaran = Pengeluaran::orderBy('id_pengeluaran', 'desc')->get();
        $no = 0;
        $data= array();
       
        foreach ($pengeluaran as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->jenis_pengeluaran;
            $row[] = "Rp. ". format_uang($list->nominal);
            $row[] = '<div class="btn-group">
                       <a onClick="editForm('.$list->id_pengeluaran.')" class="btn btn-primary btn sm">
                           <i class="fa fa-pencil"></i>
                       </a>
                       <a onClick="deleteData('.$list->id_pengeluaran.')" class="btn btn-danger btn sm">
                           <i class="fa fa-trash"></i>
                       </a>
                     </div>';
           $data[] = $row;
        }

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
        $pengeluaran = new Pengeluaran;
        $pengeluaran->jenis_pengeluaran = $request['jenis'];
        $pengeluaran->nominal = $request['nominal'];
        $pengeluaran->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        echo json_encode($pengeluaran);
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
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->jenis_pengeluaran = $request['jenis'];
        $pengeluaran->nominal = $request['nominal'];
        $pengeluaran->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();
    }
}
