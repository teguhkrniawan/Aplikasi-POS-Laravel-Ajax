<div class="modal" id="modal-produk" tabindex="-1" role="dialog" aria-hidden="true" data-bacdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"></span> &times; </button>
                <h3 class="modal-title">Cari Produk</h3>
            </div>

            <div class="modal-body">
                <table class="table table-striped tabel-detail">
                    <thead>
                        <tr>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th align="right">Harga Beli</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $data)
                        <tr>
                            <td>{{ $data->kode_produk }}</td>
                            <td>{{ $data->nama_produk }}</td>
                            <td>Rp. {{ format_uang($data->harga_beli) }}</td>
                            <td>
                                <a onclick="selectItem({{$data->kode_produk}})" class="btn btn-primary"><i
                                        class="fa fa-check-circle"></i> Pilih</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>