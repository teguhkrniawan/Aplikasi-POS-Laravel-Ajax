<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="laporan" class="form-horizontal" method="POST" data-toggle="validator">
                {{ csrf_field() }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true"> &times </span>
                    </button>

                    <h4 class="modal-title"></h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="awal" class="col-md-3 control-label">Tanggal Awal</label>
                        <div class="col-md-6">
                            <input type="text" name="awal" id="awal" class="form-control" autofocus required>
                        </div>
                        <span class="help-block with-errors"></span>
                    </div>

                    <div class="form-group">
                        <label for="akhir" class="col-md-3 control-label">Tanggal Akhir</label>
                        <div class="col-md-6">
                            <input type="text" name="akhir" id="akhir" class="form-control" autofocus required>
                        </div>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save">
                        <i class="fa fa-floppy-o"> Simpan</i>
                    </button>

                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <i class="fa fa-arrow-circle-left"> Batal</i>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>