<form id="editForm">
    <div class="modal" tabindex="-1" role="dialog" id="editModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ubah Data Member</h5>

          </div>
          <div class="modal-body">

            <div class="form-group mb-3">
                <label for="gambarEdit">Gambar</label>
                <input type="file" class="form-control" id="gambarEdit" name="gambarEdit">
            </div>

            <div class="form-group mt-3 mb-3">
                <label for="judulkelasEdit">Judul Kelas</label>
                <input type="text" class="form-control" id="judulkelasEdit" name="judulkelasEdit">
            </div>

            <div class="form-group mt-3 mb-3">
                <label for="kodeEdit">Kode Kelas</label>
                <input type="text" class="form-control" id="kodeEdit" name="kodeEdit">
            </div>

            <div class="form-group">
                <label for="kategorikelasEdit">Kategori Kelas</label>
                <select name="kategorikelasEdit" id="kategorikelasEdit" class="form-control">
                    @foreach($KategoriKelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3 mb-3">
                <label for="pengajarEdit">Pengajar</label>
                <input type="text" class="form-control" id="pengajarEdit" name="pengajarEdit">
            </div>

            {{-- <div class="form-group mt-3 mb-3">
                <label for="tgl_lhrEdit">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tgl_lhrEdit" name="tgl_lhrEdit">
            </div> --}}

            <div class="form-group mt-3 mb-3">
              <label for="hargaEdit">Biaya Kelas Per Bulan</label>
              <input type="number" min="0.01" class="form-control" id="hargaEdit" name="hargaEdit">
            </div>

            <div class="form-group mt-3 mb-3">
                <label for="deskripsiEdit">Deskripsi</label>
                <input type="textarea" class="form-control" id="deskripsiEdit" name="deskripsiEdit">
            </div>

          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="editSubmit">Save changes</button>
            </div>
        </div>
      </div>
    </div>
</form>
