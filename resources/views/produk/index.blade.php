@extends('layouts.app')

@section('title')
Daftar Produk
@endsection

@section('breadcumb')
@parent
<li>Produk</li>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle">
                    </i> Tambah
                </a>
                <a onclick="deletAll()" class="btn btn-danger"><i class="fa fa-trash">
                    </i> Hapus Semua
                </a>
                <a onclick="printBarcode()" class="btn btn-info"><i class="fa fa-barcode">
                    </i> Cetak Barcode
                </a>

            </div>
            <div class="box-body">
                <form method="POST" id="form-produk">
                    {{ csrf_field() }}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="20"><input type="checkbox" value="1" id="select-all"></th>
                                <th width="20">No</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Diskon</th>
                                <th>Stok</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- isi --}}
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@include('produk.form')
@endsection


@section('script')

<script type="text/javascript">
    var table, save_method;

// Ketika halaman ini pertama kali dijalankan
$( document ).ready( function(){
    var checkboxes = $( ':checkbox' );

    // beri nilai checkboxes false
    checkboxes.prop( 'checked', false );

});

$(function() {

    // function taampil data - plugin DataTable
    table = $('.table').DataTable({
            "processing": true,
            "serverside": true,
            "ajax": {
                "url": "{{ route('produk.data') }}",
                "type": "GET"
            },
        'columnDefs' : [{
            'targets': 0,
            'searchable': false,
            'orderable': false
        }],
        'order' : [1, 'asc']
    });

    // centang semua checkbox ketika checkbox id #select-all dicentang
    $('#select-all').click(function(){
        $('input[type="checkbox"]').prop('checked', this.checked);
    });

    // Meyimpan data dari form data/edit
    $('#modal-form form').validator().on('submit', function(e){
        if(!e.isDefaultPrevented()){

            var id = $('#id').val();

            if(save_method == "add")
                url = "{{ route('produk.store') }}";
            else 
                url = "produk/"+id;
            
            $.ajax({
                url : url,
                type: "POST",
                data: $('#modal-form form').serialize(),
                success: function(data){
                   if(data.msg == "error"){
                        alert("Kode Produk sudah digunakan");
                   }else {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                   }             
                },
                error: function(){
                    alert("Tidak dapat menyimpan data");
                }
            });
            return false; 
        }
    });

});

// function tampil form tambah
function addForm(){
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('.modal-title').text('Tambah Produk');
};

// cetak barcode
function printBarcode(){
    if($('input:checked').length < 1) {
        alert("Pilih data yang akan dicetak");
    }else {
        $('#form-produk').attr('target', '_blank').attr('action', "produk/cetak").submit();
    }
};

</script>

@endsection