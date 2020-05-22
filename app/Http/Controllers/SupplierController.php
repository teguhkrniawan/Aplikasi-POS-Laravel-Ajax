<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('supplier.index');
    }

    /**
     * Show data dari database.
     *
     * @return \Illuminate\Http\Response
     */
    public function listData(){
         
        $supplier = Supplier::orderBy('id_supplier', 'desc')->get();
        $no = 0;
        $data= array();
       
        foreach ($supplier as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->nama;
            $row[] = $list->telepon;
            $row[] = $list->alamat;
            $row[] = '<div class="btn-group">
                       <a onClick="editForm('.$list->id_supplier.')" class="btn btn-primary btn sm">
                           <i class="fa fa-pencil"></i>
                       </a>
                       <a onClick="deleteData('.$list->id_supplier.')" class="btn btn-danger btn sm">
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
        $supplier = new Supplier;
        $supplier->nama = $request['nama'];
        $supplier->telepon = $request['telepon'];
        $supplier->alamat = $request['alamat'];
        $supplier->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        echo json_encode($supplier);
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
        $supplier = Supplier::find($id);
        $supplier->nama = $request['nama'];
        $supplier->telepon = $request['telepon'];
        $supplier->alamat = $request['alamat'];
        $supplier->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
    }
}
