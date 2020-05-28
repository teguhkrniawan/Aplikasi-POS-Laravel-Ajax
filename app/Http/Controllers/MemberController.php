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
