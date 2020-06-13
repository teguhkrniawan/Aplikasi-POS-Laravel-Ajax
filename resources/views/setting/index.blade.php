@extends('layouts.app')

@section('title')
Pengaturan
@endsection

@section('breadcumb')
@parent
<li>Pengaturan</li>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <form class="form form-horizontal" data-toggle="validator" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="box-body">
                    <div class="alert alert-info alert-dismissible" style="display:none">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-check"></i>
                        Perubahan berhasil disimpan
                    </div>

                    <div class="form-group">
                        <label for="nama" class="col-md-2 control-label">Nama Perusahaan</label>
                        <div class="col-md-6">
                            <input type="text" name="nama" id="nama" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="col-md-2 control-label">Alamat</label>
                        <div class="col-md-6">
                            <input type="text" name="alamat" id="alamat" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telepon" class="col-md-2 control-label">Telepon</label>
                        <div class="col-md-6">
                            <input type="text" name="telepon" id="telepon" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="logo" class="col-md-2 control-label">Logo</label>
                        <div class="col-md-4">
                            <input type="file" name="logo" id="logo" class="form-control">
                            <br>
                            <div class="tampil-logo"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="card" class="col-md-2 control-label">Design Card Member</label>
                        <div class="col-md-4">
                            <input type="file" name="card" id="card" class="form-control">
                            <br>
                            <div class="tampil-card"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="diskon" class="col-md-2 control-label">Diskon (%)</label>
                        <div class="col-md-4">
                            <input type="number" name="diskon" id="diskon" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tipe_nota" class="col-md-2 control-label">Tipe Nota</label>
                        <div class="col-md-2">
                            <select name="tipe_nota" id="tipe_nota" class="form-control">
                                <option value="0">Nota Kecil</option>
                                <option value="1">Nota Besar</option>
                            </select>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"> Simpan
                                Perubahan</i></button>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    // function utama
$(function(){

   showData();

    $('.form').validator().on('submit', function(e){
        if (!e.isDefaultPrevented()) {
            // Upload file dengana AJAX
            $.ajax({
                url : "{{ Auth::user()->id }}/change",
                type : "POST",
                data : new FormData($(".form")[0]),
                dataType : "JSON",
                async : false,
                processData : false,
                contentType : false,
                success : function(data) {
                    if(data.msg == "error"){
                        alert('Password lama salah');
                        $('passwordLama').focus().select();
                    } else {
                        d =  new Date();
                        $('.alert').css('display', 'block').delay(2000).fadeOut();
                        $('.tampil-foto img, .user-image, .img-circle').attr('src', data.url+'?'+d.getTime());
                    }
                }, 
                error : function(){
                    alert('Tidak dapat menyimpan data');
                }
            });
            return false;
        }
    });

});

function showData() {
    $.ajax({
        url : "setting/1/edit",
        type : "GET",
        dataType : "JSON",
        success : function(data){
            $('#nama').val(data.nama_perusahaan);
            $('#alamat').val(data.alamat);
            $('#telepon').val(data.telepon);
            $('#diskon').val(data.diskon_member);
            $('#tipe_nota').val(data.tipe_nota);

            d = new Date();
            $('.tampil-logo').html('<img src="images/'+data.logo+'?'+d.getTime()+'" width="200">');
            $('.tampil-card').html('<img src="images/'+data.kartu_member+'?'+d.getTime()+'" width="200">');
        },
        error : function() {
            alert("Tidak dapat menampilkan data")
        }
    });
}


</script>
@endsection