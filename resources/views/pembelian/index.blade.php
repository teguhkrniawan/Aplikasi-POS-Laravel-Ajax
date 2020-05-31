@extends('layouts.app')

@section('title')
Daftar Pembelian
@endsection

@section('breadcumb')
@parent
<li>Pembelian</li>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle">
                    </i> Transaksi Baru
                </a>
                @if (!empty(session('idpembelian')))
                <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info"><i class="fa fa-plus-circle">
                    </i> Transaksi Aktif
                </a>
                @endif
            </div>
            <div class="box-body">
                <table class="table table-striped tabel-pembelian">
                    <thead>
                        <tr>
                            <th width="30">No</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Total Item</th>
                            <th>Total Harga</th>
                            <th>Diskon</th>
                            <th>Total Bayar</th>
                            <th width="100">Aksi</th>
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

@include('pembelian.detail')
@include('pembelian.supplier')
@endsection

@section('script')
<script type="text/javascript">
    var table, save_method, table1;

$(function() {

    // function taampil data - plugin DataTable
    table = $('.tabel-pembelian').DataTable({
        "processing": true,
        "serveside": true,
        "ajax": {
            "url": "{{ route('pembelian.data') }}",
            "type": "GET"
        }
    });

    table1 = $('.tabel-detail').DataTable({
        "dom" : 'Brt',
        "bSort" : false,
        "processing" : true
    });

    $('.tabel-supplier').DataTable();

});

// function tampil form tambah
function addForm(){
    $('#modal-supplier').modal('show');
};

// function hapus data
function deleteData(id){
    if(confirm("Apakah yakin ingin dihapus ?")){
        $.ajax({
            url : "pembelian/"+id,
            type : "POST",
            data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf_token]').attr('content')},
            success : function(data){
                table.ajax.reload();
            },
            error : function(){
                alert("Tidak dapat menghapus data");
            }
        });
    }
}

// function tampil detail pembelian
function showDetail(id){
  $('#modal-detail').modal('show');

  table1.ajax.url("pembelian/"+id+"/lihat");
  table1.ajax.reload();
}
   
</script>
@endsection