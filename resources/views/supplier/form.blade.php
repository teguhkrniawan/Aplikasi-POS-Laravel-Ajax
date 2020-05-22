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
                        <label for="nama" class="col-md-3 control-label">Nama</label>
                        <div class="col-md-6">
                            <input type="text" name="nama" id="nama" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telepon" class="col-md-3 control-label">Telepon</label>
                        <div class="col-md-6">
                            <input type="text" name="telepon" id="telepon" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="col-md-3 control-label">Alamat</label>
                        <div class="col-md-6">
                            <input type="text" name="alamat" id="alamat" class="form-control" autofocus required>
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