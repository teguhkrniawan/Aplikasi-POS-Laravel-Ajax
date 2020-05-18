<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori.index');
    }

    /**
     * Menampilkan list data menggunakan AJAX
     */

     public function listData(){
         
         $kategori = Kategori::orderBy('id_kategori', 'desc')->get();
         $no = 0;
         $data= array();
        
         foreach ($kategori as $list) {
             $no++;
             $row = array();
             $row[] = $no;
             $row[] = $list->nama_kategori;
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

         $output = array("data" => $data);

         return response()->json($output);
     }


    /**
     * Store digunakan untuk simpan data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kategori = new Kategori;
        $kategori->nama_kategori = $request['nama'];
        $kategori->save();
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
