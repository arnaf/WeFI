<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="#">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

           <!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Pendaftaran Bimbel</span>
        </a>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-credit-card"></i><span>Tagihan</span>
        </a>
      </li><!-- End Tables Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clock-history"></i><span>Riwayat Pembayaran</span>
        </a>
      </li><!-- End Charts Nav -->

           <!-- End Icons Nav -->


    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journals"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/user') }}">
                      <i class="bi bi-circle"></i><span>Member</span>
                    </a>
                  </li>
                  <li>
                    <a href="tables-data.html">
                      <i class="bi bi-circle"></i><span>Kategori Kelas</span>
                    </a>
                  </li>
                  <li>
                    <a href="tables-data.html">
                        <i class="bi bi-circle"></i><span>Kelas</span>
                      </a>
                </li>
        </ul>
    </li>


</aside>
