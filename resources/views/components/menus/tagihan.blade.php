@extends('components.layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tagihan Pembayaran Bimbel</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tagihan</li>
          </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tagihan</h5>

          <table class="table table-hover">




              <thead>
                  <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama Member</th>
                      <th scope="col">Nomor Invoice</th>
                      <th scope="col">Kelas</th>
                      <th scope="col">Jumlah Tagihan</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>

                      <th scope="col">Lihat Bukti Tagihan</th>
                    </tr>
                </thead>
                <tbody>


            @foreach ( $relations as $r)


            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->invoice }}</td>
                <td>{{ $r->judulkelas }}</td>
                <td>Rp. {{ $r->harga }}</td>


                    @if ($r->status == "Belum dibayar")


                        <td>
                            <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> {{ $r->status }}</span>
                        </td>

                        <td>
                            <form action=" " method=" ">
                                @csrf
                            <button type="submit" class="btn btn-success" disabled><i class="bi bi-check-circle" ></i><br>Verif</button>
                            </form>
                        </td>



                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal" disabled>
                                Bukti Belum Terupload
                            </button>
                        </td>
                    @endif
                    @if ($r->status == "Dalam verifikasi Admin")
                        <td>
                            <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> {{ $r->status }}</span>
                        </td>

                        <td>

                            <form action="{{ route('accept', $r->id) }}" method="post">
                                @csrf
                            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle" ></i><br>Verif</button>
                            </form>

                            <form action="{{ route('reject', $r->id) }}" method="post">
                                @csrf
                            <button type="submit" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i><br>Tolak</button>
                            </form>
                        </td>

                      


                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                                Lihat Bukti
                              </button>
                              <div class="modal fade" id="basicModal" tabindex="-1">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Bukti Pembayaran Oleh {{ $r->nama }}</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <img class="foto-view" src="{{ asset('assets/images/bukti') . '/' . $r->foto }}">
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </td>
                    @endif



                {{-- BUAT LOGIC JIKA USER DENGAN ID INI MAKA YANG MUNCUL TOMBOL INI DENGAN TAGIHAN HANYA UNTUK USER DENGAN ID INI. JIKA ADMIN, YANG MUNCUL TOMBOL HAPUS TAGIHAN, DAN VERIFIKASI. --}}


            @endforeach
            </tbody>
          </table>
          <!-- End Table with hoverable rows -->

        </div>
      </div>



</main>
@endsection
