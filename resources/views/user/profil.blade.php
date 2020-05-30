@extends('layouts.app')

@section('title')
Edit Profil
@endsection

@section('breadcumb')
@parent
<li>User</li>
<li>Edit Profil</li>
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
                        <label for="foto" class="col-md-2 control-label">Foto Profil</label>
                        <div class="col-md-4">
                            <input type="file" name="foto" id="foto" class="form-control">
                            <br>
                            <div class="tampil-foto">
                                <img src="{{ asset('images/'. Auth::user()->foto) }}" width="200">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="passwordLama" class="col-md-2 control-label">Password Lama</label>
                        <div class="col-md-4">
                            <input type="text" name="passwordLama" id="passwordLama" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="passwordBaru" class="col-md-2 control-label">Password Baru</label>
                        <div class="col-md-4">
                            <input type="password" name="passwordBaru" id="passwordBaru" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password1" class="col-md-2 control-label">Ulangi Password</label>
                        <div class="col-md-4">
                            <input type="password" name="password1" id="password1" class="form-control"
                                data-match="#passwordBaru">
                            <span class="help-block with-errors"></span>
                        </div>
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

    // Saat input text password lama dikasi event atau ditrigger
    $('#passwordLama').keyup(function(){
        if ($(this).val() != '') {
            $('#passwordBaru').attr('required', true);
            $('#password1').attr('required', true);
        } else {
            $('#passwordBaru').attr('required', false);
            $('#password1').attr('required', false);
        }   
    });

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


</script>
@endsection