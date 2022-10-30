@extends('components.layouts.app')

@section('content')
<main id="main" class="main">



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
              </tr>
            </thead>
            <tbody>
                <?php $i= 1;?>
            @foreach ( $relations as $r)

            <tr>
                <th scope="row">{{ $i }}</th>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->invoice }}</td>
                <td>{{ $r->judulkelas }}</td>
                <td>Rp. {{ $r->harga }}</td>
                @if ($r->status == "Belum dibayar")
                    <td><span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> {{ $r->status }}</span></td>
                    @elseif ($r->status == "Dalam verifikasi Admin")
                    <td><span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> {{ $r->status }}</span></td>
                    @else
                    <td><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> {{ $r->status }}</span></td>
                @endif

                {{-- BUAT LOGIC JIKA USER DENGAN ID INI MAKA YANG MUNCUL TOMBOL INI DENGAN TAGIHAN HANYA UNTUK USER DENGAN ID INI. JIKA ADMIN, YANG MUNCUL TOMBOL HAPUS TAGIHAN, DAN VERIFIKASI. --}}


                <td> <form action="" method="post">
                    {{-- <button type="sumbit" class="btn btn-success rounded-pill">Verif Pembayaran</button> --}}
                    <button type="button" class="btn btn-secondary"><i class="bi bi-collection"></i><br>Verif</button>

                </form>
                </form>
                </td>
            </tr>
            <?php $i++; ?>
            @endforeach
            </tbody>
          </table>
          <!-- End Table with hoverable rows -->

        </div>
      </div>



</main>
@endsection
