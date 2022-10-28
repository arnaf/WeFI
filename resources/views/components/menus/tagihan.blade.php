@extends('components.layouts.app')

@section('content')
<main id="main" class="main">

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <div class="col-sm-6">
              <h1>Tagihan</h1>
            </div>

          <div class="card-tools">

          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">

                  {{-- <button type="button" class="my-3 btn btn-primary" onclick="create()">Tambah Member</button> --}}

              <table class="table table-hover table-striped table-border" id="table">

                  <thead>
                      <th>#</th>
                      <th>No Invoice</th>
                      <th>Nama Member</th>
                      <th>Kelas</th>
                      <th>Tagihan</th>
                      <th>Tindakan</th>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
          </div>
        </div>
      </div>
      @include('components.menus.pendaftaran')
      {{-- @include('components.modals.user.edit') --}}
      <!-- /.card -->

    </section>
    <!-- /.content -->
    @push('script')
      @include('components.scripts.datatables')
      @include('components.scripts.sweetalert')
  
    @endpush
  </section>






</main>
@endsection
