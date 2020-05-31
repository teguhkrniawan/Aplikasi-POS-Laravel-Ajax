@extends('layouts.app')

@section('title')
Transaksi Pembelian
@endsection

@section('breadcumb')
@parent
<li>Pembelian</li>
<li>Tambah</li>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-body">
                <table>
                    <tr>
                        <td width="100">Supplier </td>
                        <td width="10">: </td>
                        <td><b>{{ $supplier->nama }}</b></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: </td>
                        <td><b>{{ $supplier->alamat }}</b></td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td>: </td>
                        <td><b>{{ $supplier->telepon }}</b></td>
                    </tr>
                </table>

                <hr>
                {{-- STRAT FORM PRODUK --}}
                <form class="form form-horizontal form-produk" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="idpembelian" id="idpembelian" value="{{ $idpembelian }}">

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="kode">Kode Produk</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" name="kode" id="kode" class="form-control" autofocus required>
                                <span class="input-group-btn">
                                    <button type="button" onclick="showProduct()" class="btn btn-info">...</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- END FORM PRODUK --}}
                {{-- =================================================== --}}
                {{-- START FORM KERANJANG --}}
                <form class="form-keranjang">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <table class="table table-striped tabel-pembelian">
                        <thead>
                            <tr>
                                <th width="20">No</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th align="right">Harga</th>
                                <th>Jumlah</th>
                                <th align="right">Sub Total</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </form>
                {{-- END FORM KERANJANG --}}
            </div>
        </div>
    </div>
</div>

@include('pembelian_detail.produk')
@endsection

@section('script')
<script type="text/javascript">
    var table;

$(function() {

    // function taampil data - plugin DataTable
    $('.tabel-produk').DataTable();

    table = $('.tabel-pembelian').DataTable({
        "dom" : 'Brt',
        "bSort" : false,
        "processing" : true,
        "ajax" : {
            "url" : "{{ route('pembelian_detail.data', $idpembelian) }}",
            "type" : 'GET'
        }
    });
    
   // Menghindari submit form saat dienter pada kode produk dan jumlah
   $('.form-produk').on('submit', function(){
        return false;
   });

   $('.form-keranjang').on('submit', function(){
        return false;
   });

});

function showProduct(){
    $('#modal-produk').modal('show');
}

function selectItem(kode){
    $('#kode').val(kode);
    $('#modal-produk').modal('hide');
    addItem();
}

function addItem(){
    $.ajax({
        url :  "{{ route('pembelian_detail.store') }}",
        type : "POST",
        data : $('.form-produk').serialize(),
        success : function(data){
            $('#kode').val('').focus();
            table.ajax.reload(function(){
                 //loadForm diskon
            });
        },
        error : function(){
            alert('Tidak dapat menyimpan data');
        }
    });
}


// function hapus data
function deleteData(id){
    if(confirm("Apakah yakin ingin dihapus ?")){
        $.ajax({
            url : "pengeluaran/"+id,
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

// function tampil form edit
function editForm(id){
   save_method = "edit";
   $('input[name=_method').val('PATCH');
   $('#modal-form form')[0].reset();
   $.ajax({
       url : "pengeluaran/"+id+"/edit",
       type : "GET",
       dataType : "JSON",
       success : function(data){
           $('#modal-form').modal('show');
           $('.modal-title').text('Edit Pengeluaran');

           $('#id').val(data.id_pengeluaran);
           $('#jenis').val(data.jenis_pengeluaran);
           $('#nominal').val(data.nominal);
       },
       error : function(){
           alert("Tidak dapat menampilkan data");
       }
   });
}
   
</script>
@endsection