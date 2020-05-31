<div class="modal" id="modal-supplier" tabindex="-1" role="dialog" aria-hidden="true" data-bacdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"></span> &times; </button>
                <h3 class="modal-title">Pilih Supplier</h3>
            </div>

            <div class="modal-body">
                <table class="table table-striped tabel-supplier">
                    <thead>
                        <tr>
                            <th width="40">Nama Supplier</th>
                            <th width="60">Alamat</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supplier as $data)
                        <tr>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>{{ $data->telepon }}</td>
                            <td><a href="pembelian/{{ $data->id_supplier }}/tambah" class="btn btn-primary"><i
                                        class="fa fa-check-circle"> Pilih</i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>