@extends('layouts.app')

@section('title')
Daftar Pengeluaran
@endsection

@section('breadcumb')
@parent
<li>Pengeluaran</li>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle">
                    </i> Tambah
                </a>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="30">No</th>
                            <th>Jenis Pengeluaran</th>
                            <th>Nominal</th>
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

@include('pengeluaran.form')
@endsection

@section('script')
<script type="text/javascript">
    var table, save_method;

$(function() {

    // function taampil data - plugin DataTable
    table = $('.table').DataTable({
        "processing": true,
        "ajax": {
            "url": "{{ route('pengeluaran.data') }}",
            "type": "GET"
        }
    });
    
    // function menyimpan data dengan validasi pada form tambah/edit
    $('#modal-form form').validator().on('submit', function(e){
        if(!e.isDefaultPrevented()){

            var id = $('#id').val();

            if(save_method == "add")
                url = "{{ route('pengeluaran.store') }}";
            else 
                url = "pengeluaran/"+id;
            
            $.ajax({
                url : url,
                type: "POST",
                data: $('#modal-form form').serialize(),
                success: function(data){
                    $('#modal-form').modal('hide');
                    table.ajax.reload();                
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
    $('.modal-title').text('Tambah Daftar Pengeluaran');
};

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