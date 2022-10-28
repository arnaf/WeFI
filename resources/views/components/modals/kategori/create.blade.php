
<form id="createForm">
    <div class="modal" tabindex="-1" role="dialog" id="createModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Kategori Kelas</h5>

          </div>
          <div class="modal-body">
            <div class="form-group mt-3 mb-3">
                <label for="kategori">Nama Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori">
                @error('kategori')
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
