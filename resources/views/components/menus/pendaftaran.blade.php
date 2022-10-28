@extends('components.layouts.app')

@section('content')
<main id="main" class="main">

    <!-- Main content -->
    <section class="content">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Form Pendaftaran Bimbel</h5>

                <!-- General Form Elements -->
                <form id="createForm">
                {{-- <div class="modal" tabindex="-1" role="dialog" id="createModal"> --}}

                    <div class="row mb-3">
                        <label for="invoiceMember" class="col-sm-2 col-form-label">No. Invoice</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="invoiceMember" name="invoiceMember">
                        </div>
                    </div>

                  <div class="row mb-3">
                    <label for="namaMember" class="col-sm-2 col-form-label">Nama Pendaftar</label>
                    <div class="col-sm-10">
                        <select name="namaMember" id="namaMember" class="form-control">
                            <option value="" selected disabled>Pilih Member</option>
                            @foreach($members as $m)
                                <option value="{{ $m->id }}">{{ $m->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="alamatMember" class="col-sm-2 col-form-label">Alamat Pendaftar</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="alamatMember" name="alamatMember" disabled>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="kelasMember" class="col-sm-2 col-form-label">Kelas Dipilih</label>
                    <div class="col-sm-10">
                        <select name="kelasMember" id="kelasMember" class="form-control">
                            <option value="" selected disabled>Pilih kelas</option>
                            @foreach($kelases as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="namaPengajar" class="col-sm-2 col-form-label">Pengajar</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="" id="namaPengajar" name="namaPengajar" disabled>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="biayaKelas" class="col-sm-2 col-form-label">Biaya Perlu Dibayar</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="Rp. " disabled id="biayaKelas" name="biayaKelas" >
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="metodeMember" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="metodeMember" name="metodeMember">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="button" class="btn btn-primary" id="createSubmit">Daftar</button>
                    </div>
                  </div>





                {{-- </div> --}}
                </form><!-- End General Form Elements -->

              </div>
            </div>

          </div>

      {{-- @include('components.modals.user.create')
      @include('components.modals.user.edit') --}}
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
