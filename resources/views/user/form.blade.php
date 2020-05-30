<div class="modal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-bacdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" data-toggle="validator" method="POST">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="Nama Lengkap" class="col-md-3 control-label">Nama Lengkap</label>
                        <div class="col-md-6">
                            <input type="text" name="nama" id="nama" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" name="email" id="email" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" name="password" id="password" class="form-control" autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password1" class="col-md-3 control-label">Ulangi Password</label>
                        <div class="col-md-6">
                            <input type="password" name="password1" id="password1" class="form-control"
                                data-match="#password" autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o">
                            Simpan</i></button>
                    <button type="submit" class="btn btn-warning" data-dismiss="modal"><i
                            class="fa fa-arrow-circle-left">
                            Batal</i></button>
                </div>
            </form>
        </div>
    </div>
</div>