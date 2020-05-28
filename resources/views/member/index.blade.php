@extends('layouts.app')

@section('title')
Daftar Member
@endsection

@section('breadcumb')
@parent
<li>Member</li>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle">
                    </i> Tambah
                </a>
                <a onclick="printCard()" class="btn btn-info"><i class="fa fa-barcode">
                    </i> Cetak Kartu
                </a>

            </div>
            <div class="box-body">
                <form method="POST" id="form-member">
                    {{ csrf_field() }}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="20"><input type="checkbox" value="1" id="select-all"></th>
                                <th width="20">No</th>
                                <th>Kode Member</th>
                                <th>Nama Lengkap</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
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

@include('member.form')
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
            "ajax": {
                "url": "{{ route('member.data') }}",
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
                url = "{{ route('member.store') }}";
            else 
                url = "member/"+id;
            
            $.ajax({
                url : url,
                type: "POST",
                data: $('#modal-form form').serialize(),
                dataType: 'JSON',
                success: function(data){
                   if(data.msg=="error"){
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
    $('#modal-form form')[0].reset();
    $('#kode').attr('readonly', false);
    $('input[name=_method]').val('POST');
    $('#modal-form').modal('show');
    $('.modal-title').text('Tambah Member');
};

// cetak barcode
function printCard(){
    if($('input:checked').length < 1) {
        alert("Pilih data yang akan dicetak");
    }else {
        $('#form-member').attr('target', '_blank').attr('action', "member/cetak").submit();
    }
};


//function hapus satu
function deleteData(id){
    if(confirm("Apakah yakin ingin dihapus ?")){
        $.ajax({
            url : "member/"+id,
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
       url : "member/"+id+"/edit",
       type : "GET",
       dataType : "JSON",
       success : function(data){
           $('#modal-form').modal('show');
           $('.modal-title').text('Edit Member');

           $('#id').val(data.id_member);
           $('#kode').val(data.kode_member).attr('readonly', true);
           $('#nama').val(data.nama);
           $('#telepon').val(data.telepon);
           $('#alamat').val(data.alamat);
       },
       error : function(){
           alert("Tidak dapat menampilkan data");
       }
   });
}

</script>

@endsection