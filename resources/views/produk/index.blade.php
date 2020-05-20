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
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script type="text/javascript">
    var table, save_method;

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

});
</script>

@endsection