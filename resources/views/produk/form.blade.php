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
                        <label for="kode" class="col-md-3 control-label">Kode Produk</label>
                        <div class="col-md-6">
                            <input type="number" name="kode" id="kode" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-md-3 control-label">Nama Produk</label>
                        <div class="col-md-6">
                            <input type="text" name="nama" id="nama" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="col-md-3 control-label">Kategori</label>
                        <div class="col-md-6">
                            <select id="kategori" type="text" class="form-control" name="kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $list)
                                <option value="{{ $list->id_kategori }}">{{ $list->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="merk" class="col-md-3 control-label">Merk</label>
                        <div class="col-md-6">
                            <input type="text" name="merk" id="merk" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga_beli" class="col-md-3 control-label">Harga Beli</label>
                        <div class="col-md-6">
                            <input type="number" name="harga_beli" id="harga_beli" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="diskon" class="col-md-3 control-label">Diskon</label>
                        <div class="col-md-6">
                            <input type="number" name="diskon" id="diskon" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga_jual" class="col-md-3 control-label">Harga Jual</label>
                        <div class="col-md-6">
                            <input type="number" name="harga_jual" id="harga_jual" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stok" class="col-md-3 control-label">Stok</label>
                        <div class="col-md-6">
                            <input type="number" name="stok" id="stok" class="form-control" required>
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