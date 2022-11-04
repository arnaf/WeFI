@extends('components.layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Riwayat Pembayaran : Gagal</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Riwayat Pembayaran</li>
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

                <th scope="col">Lihat Bukti Tagihan</th>

              </tr>
            </thead>
            <tbody>
                @foreach ( $relations as $r)

            <tr>
                @if ($r->status == "Ditolak")
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->invoice }}</td>
                <td>{{ $r->judulkelas }}</td>
                <td>Rp. {{ $r->harga }}</td>



                        <td>
                            <span class="badge bg-dark"><i class="bi bi-exclamation-triangle me-1"></i> {{ $r->status }}</span>
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




            </tr>
            @endforeach
            </tbody>
          </table>
          <!-- End Table with hoverable rows -->

        </div>
      </div>



</main>
@endsection
