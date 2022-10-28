@extends('components.layouts.app')

@section('content')
<main id="main" class="main">



    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Table with hoverable rows</h5>

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
            @foreach ( $tagihans as $t)

            <?php $i= 1;?>
            <tr>
                <th scope="row">{{ $i }}</th>
                <td>{{ $t->user_id }}</td>
                <td>{{ $t->invoice }}</td>
                <td>{{ $t->kelas_id }}</td>
                <td>2016-05-25</td>
            </tr>

            @endforeach
            </tbody>
          </table>
          <!-- End Table with hoverable rows -->

        </div>
      </div>



</main>
@endsection
