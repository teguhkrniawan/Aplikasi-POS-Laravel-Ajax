<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use PDF;

class MemberController extends Controller
{
    /**
     * Menampilkan data member
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.index');
    }

    /**
     * List data logic.
     *
     * @return \Illuminate\Http\Response
     */
    public function listData()
    {
        $member = Member::orderBy('id_member', 'desc')->get();
        $no = 0;
        $data= array();
    
        foreach ($member as $list) {
            $no++;
            $row = array();
            $row[] = "<input type='checkbox' name='id[]' value='".$list->id_member."'>";
            $row[] = $no;
            $row[] = $list->kode_member;
            $row[] = $list->nama;
            $row[] = $list->alamat;
            $row[] = $list->telepon;
            $row[] = '<div class="btn-group">
                    <a onClick="editForm('.$list->id_member.')" class="btn btn-primary btn sm">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a onClick="deleteData('.$list->id_member.')" class="btn btn-danger btn sm">
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
        $jml = Member::where('kode_member', '=', $request['kode'])->count();
        if ( $jml < 1 ) {
            $member = new Member;
            $member->kode_member    = $request['kode'];
            $member->nama           = $request['nama'];
            $member->telepon        = $request['telepon'];
            $member->alamat         = $request['alamat'];
            $member->save();

            echo json_encode(array('msg' => 'success'));
        } else {
            echo json_encode(array('msg' => 'error'));
        }
    }


    /**
     * Menampilkan value pada edit data.s
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        echo json_encode($member);
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
        $member = Member::find($id);
        $member->nama = $request['nama'];
        $member->telepon = $request['telepon'];
        $member->alamat = $request['alamat'];
        $member->update();

        echo json_encode(array('msg' => 'success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
    }

    public function printCard(Request $request){
        $datamember = array();
        foreach ($request['id'] as $id) {
            $member = Member::find($id);
            $datamember[] = $member;
        }

        $pdf = PDF::loadView('member.card', compact('datamember'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
