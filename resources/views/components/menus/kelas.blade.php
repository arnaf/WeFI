@extends('components.layouts.app')

@section('content')
<main id="main" class="main">

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <div class="col-sm-6">
              <h1>Daftar Kelas</h1>
            </div>

          <div class="card-tools">

          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">

                  <button type="button" class="my-3 btn btn-primary" onclick="create()">Tambah Kelas</button>

              <table class="table table-hover table-striped table-border" id="table">

                  <thead>
                      <th>#</th>
                      <th>Gambar</th>
                      <th>Kode</th>
                      <th>Judul Kelas</th>
                      <th>Kategori</th>
                      <th>Pengajar</th>
                      <th>Harga</th>
                      <th>Deskripsi</th>
                      <th>Tindakan</th>
                  </thead>

                  <tbody>


                  </tbody>
              </table>
          </div>
        </div>
      </div>
      @include('components.modals.kelas.create')
      @include('components.modals.kelas.edit')
      <!-- /.card -->

    </section>
    <!-- /.content -->
    @push('script')
      @include('components.scripts.datatables')
      @include('components.scripts.sweetalert')
      @include($script)
    @endpush
  </section>

</main>
@endsection
