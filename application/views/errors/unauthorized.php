<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>Akses Ditolak</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="error-page">
        <h2 class="headline text-warning"><i class="fas fa-exclamation-triangle"></i></h2>

        <div class="error-content">
          <h3><i class="fas fa-ban text-warning"></i> Oops! Akses Ditolak (403 Forbidden)</h3>

          <p>
            Anda tidak memiliki izin untuk mengakses halaman ini.
            <br>
            <strong>Fitur "Rekapitulasi Unit Kerja"</strong> hanya dapat diakses oleh:
          </p>
          
          <ul class="list-unstyled">
            <li><i class="fas fa-check text-success"></i> Tim Evaluator</li>
            <li><i class="fas fa-check text-success"></i> Admin Evaluator</li>
          </ul>

          <p class="mt-3">
            Jika Anda merasa ini adalah kesalahan atau memerlukan akses ke fitur ini, 
            silakan hubungi administrator sistem.
          </p>

          <div class="mt-4">
            <a href="<?php echo base_url('home/index'); ?>" class="btn btn-primary">
              <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
            <a href="<?php echo base_url('dashboard/index'); ?>" class="btn btn-default">
              <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
