@extends('layouts.app')

@section('title')
Daftar Penjualan
@endsection

@section('breadcumb')
@parent
<li>Penjualan</li>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">

            </div>
            <div class="box-body">
                <table class="table table-striped tabel-penjualan">
                    <thead>
                        <tr>
                            <th width="30">No</th>
                            <th>Tanggal</th>
                            <th>Kode Member</th>
                            <th>Total Item</th>
                            <th>Total Harga</th>
                            <th>Diskon</th>
                            <th>Total Bayar</th>
                            <th>Kasir</th>
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

@include('penjualan.detail')
@endsection

@section('script')
<script type="text/javascript">
    var table, save_method, table1;


$(function() {

    // function tampil data - plugin DataTable - untuk tabel penjualan
    table = $('.tabel-penjualan').DataTable({
        "processing": true,
        "ajax": {
            "url": "{{ route('penjualan.data') }}",
            "type": "GET"
        }
    });
    
    // function tampil data di tabel-detail ketika klik icon mata
    table1 = $('.tabel-detail').DataTable({
       'dom' : 'Brt',
       'bSort' : false,
       'processing' : true
    })

    // $('.tabel-supplier').DataTable();
});

// function tampil detail penjualan
function showDetail(id){
  $('#modal-detail').modal('show');

  table1.ajax.url("penjualan/"+id+"/lihat");
  table1.ajax.reload();
}

// function tampil form tambah
function addForm(){
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('.modal-title').text('Tambah User');
    $('#password').attr('required', true);
    $('#password1').attr('required', true);
};

// function hapus data
function deleteData(id){
    if(confirm("Apakah yakin ingin dihapus ?")){
        $.ajax({
            url : "user/"+id,
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
 
</script>
@endsection