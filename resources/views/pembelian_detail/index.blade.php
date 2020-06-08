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
                <form class="form form-horizontal form-produk" method="POST" id="form-produk">
                    {{ csrf_field() }}
                    <input type="hidden" name="idpembelian" id="idpembelian" value="{{ $idpembelian }}">

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="kode">Kode Produk</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="hidden" name="id" id="id" class="form-control" autofocus required>
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
                <form class="form-keranjang" id="form-keranjang">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <table class="table table-striped tabel-pembelian">
                        <thead>
                            <tr>
                                <th></th>
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

                {{-- Start tampil box total bayar --}}
                <div class="col-md-8">
                    <div id="tampil-bayar" style="background: #dd4b39;
                                    color: #fff;
                                    font-size: 60px;
                                    text-align: center;
                                    height: 100px">
                    </div>
                    <div id="tampil-terbilang" style="background: #3c8dbc;
                                    color: #fff;
                                    font-weight: bold;
                                    padding: 10px">
                    </div>
                </div>
                {{-- End tampil box total bayar --}}

                {{-- start disamping box total bayar --}}
                <div class="col-md-4">
                    <form class="form form-horizontal form-pembelian" method="POST"
                        action="{{ route('pembelian.store') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="idpembelian" id="idpembelian" value="{{ $idpembelian }}">
                        <input type="hidden" name="total" id="total">
                        <input type="hidden" name="totalitem" id="totalitem">
                        <input type="hidden" name="bayar" id="bayar">

                        <div class="form-group">
                            <label for="totalrp" class="col-md-4 control-label">Total Harga</label>
                            <div class="col-md-6">
                                <input type="text" name="totalrp" id="totalrp" readonly class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="diskon" class="col-md-4 control-label">Diskon</label>
                            <div class="col-md-6">
                                <input type="number" name="diskon" id="diskon" value="0" class="form-control">
                                <span class="help-block">*Tekan Enter Untuk Hitung</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bayarrp" class="col-md-4 control-label">Total Bayar</label>
                            <div class="col-md-6">
                                <input type="text" name="bayarrp" id="bayarrp" readonly class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                {{-- end disamping box total bayar --}}
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right simpan"><i class="fa fa-floppy-o">
                        Simpan Transaksi</i></button>
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
    }).on('draw.dt', function() {
       loadForm($('#diskon').val()); 
    });
    
   // Menghindari submit form saat dienter pada kode produk dan jumlah
   $('.form-produk').on('submit', function(){
        return false;
   });

   $('.form-keranjang').on('submit', function(){
        return false;
   });

   // Trigger ketika select diskon dan jumlah diubah
   $('#diskon').change(function(){
        if($(this).val == "")
            $(this).val(0).select();
        loadForm($(this).val());
   })

   // ketika tekan button simpan transasksi
   $('.simpan').click(function(){
        $('.form-pembelian').submit();
   });

});

// Menampilkan produk ketika klik button (...)
function showProduct(){
    $('#modal-produk').modal('show');
}

// method ketika klik pilih produk
function selectItem(kode){
    $('#kode').val(kode);
    //$('#id').val(16);
    $('#modal-produk').modal('hide');
    addItem();
}

// Menambahkan item ke form-keranjang
function addItem(){
    $.ajax({
        url :  "{{ route('pembelian_detail.store') }}",
        type : "POST",
        data : $('.form-produk').serialize(),
        success : function(data){
            //$('#kode').val('').focus();
            //$('#id').val('').focus();
            table.ajax.reload(function(){
                 //loadForm diskon
            });
        },
        error : function(){
            alert('Tidak dapat menyimpan data');
        }
    });
}

// method hitungan ketika terjadi perubahan pada text input jumlah

/*
* parameter id dan id_produk didapatkan dari method list data pada PembelianDetailController
* lihat bagian textfield jumlah pada atribut onChange disana diberi sebuah function changeCount
*/
function changeCount(id, id_produk){ // id = id_detail_pembelian
    
    $.ajax({
        url : "pembelian_detail/"+id,
        type : "POST",
        data : $('#form-keranjang, #form-produk').serialize(),
        success : function(data){
            //$('#kode').val('').focus();
            //$('#id').val('').focus();
            table.ajax.reload(function(){
                loadForm($('#diskon').val());
            });
        }, error : function(){
            alert("Gagal jalankan method changeCount");
        }
    });
}

// function nilaiID(id_produk){
//     $('#produk_id').val(id_produk);
// }


// function hapus data
function deleteItem(id){
    if(confirm("Apakah yakin ingin dihapus ?")){
        $.ajax({
            url : "pembelian_detail/"+id,
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

// function loadForm untuk menampilkan total harga
function loadForm(diskon=0){
    $('#total').val($('.total').text());
    $('#totalitem').val($('.totalitem').text());

    $.ajax({
        url : "pembelian_detail/loadform/"+diskon+"/"+$('.total').text(),
        type : "GET",
        dataType : "JSON",
        success : function(data){
            $('#tampil-bayar').text("Rp. " +data.bayarrp);
            $('#tampil-terbilang').text(data.terbilang);
            $('#totalrp').val("Rp. "+data.totalrp);
            $('#bayarrp').val("Rp. "+data.bayarrp);
            $('#bayar').val(data.bayar);
            //$('#total_item').val(data.totalitem);
        },
        error : function(){
            alert("Tidak dapat menampilkan data (log.e : loadForm");
        }
    });
}

   
</script>
@endsection