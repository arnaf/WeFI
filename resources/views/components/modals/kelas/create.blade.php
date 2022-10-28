<form id="createForm">
    <div class="modal" tabindex="-1" role="dialog" id="createModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Kelas</h5>

          </div>
          <div class="modal-body">

            <div class="form-group mt-3 mb-3">
                  <label for="gambar">Gambar</label>
                  <input type="file" class="form-control" required data-allowed-file-extensions="jpg png" data-max-file-size-preview="3M" id="gambar"  name="gambar">
                  @error('gambar')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
            </div>
            <div class="form-group mt-3 mb-3">
                <label for="judulkelas">Judul Kelas</label>
                <input type="text" class="form-control" id="judulkelas" name="judulkelas">
                @error('judulkelas')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group mt-3 mb-3">
                <label for="kode">Kode Kelas</label>
                <input type="text" class="form-control" id="kode" name="kode">
                @error('kode')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>


            <div class="form-group">
                <label for="kategorikelas">Kategori Kelas</label>
                <select name="kategorikelas" id="kategorikelas" class="form-control">
                    <option value="" selected disabled>Pilih Kategori</option>
                    @foreach($KategoriKelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3 mb-3">
                <label for="pengajar">Pengajar</label>
                <input type="text" class="form-control" id="pengajar" name="pengajar">
                @error('pengajar')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group mt-3 mb-3">
                <label for="harga">Biaya Kelas Per Bulan</label>
                <input type="number" min="0.01" class="form-control" id="harga" name="harga" required>
                @error('harga')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group mt-3 mb-3">
                <label for="deskripsi" class="col-form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi">{{old('deskripsi')}}</textarea>
                @error('deskripsi')
                  <span class="text-danger">{{$message}}</span>
                @enderror
            </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="createSubmit">Save changes</button>
          </div>
        </div>
      </div>
    </div>
</form>
