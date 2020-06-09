@extends('layouts.app')

@section('title')
Laporan Pendapatan {{ tanggal_indonesia($awal, false) }} s/d {{ tanggal_indonesia($akhir, false) }}
@endsection

@section('breadcumb')
@parent
<li>Laporan</li>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <a onclick="periodeForm()" class="btn btn-success"><i class="fa fa-plus-circle">
                    </i> Ubah Periode
                </a>
                <a href="laporan/pdf/{{$awal}}/{{$akhir}}" class="btn btn-info" target="_blank"><i
                        class="fa fa-file-pdf-o">
                    </i> Export PDF
                </a>
            </div>
            <div class="box-body">
                <table class="table table-striped tabel-laporan">
                    <thead>
                        <tr>
                            <th width="30">No</th>
                            <th>Tanggal</th>
                            <th>Penjualan</th>
                            <th>Pembelian</th>
                            <th>Pengeluaran</th>
                            <th>Pendapatan</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- isi --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('laporan.form')
@endsection

@section('script')
<script type="text/javascript">
    var table;

$(function() {

    // menampilkan date picker
    $('#awal, #akhir').datepicker({
        format : 'yyyy-mm-dd',
        autoclose :  true
    });

    // function tampil data pada tabel-laporan
    table = $('.tabel-laporan').DataTable({
        'dom' : 'Brt',
        'bSort' : false,
        'bPaqinate' : false,
        'processing' : true,
        'serverside' : true,
        'ajax' : {
            "url" : "laporan/data/{{$awal}}/{{$akhir}}",
            "type" : "GET"
        }
    });
});

// function tampil form tambah
function periodeForm(){
    $('#modal-form').modal('show');
    $('.modal-title').text('Filter Tanggal Laporan');
};


   
</script>
@endsection