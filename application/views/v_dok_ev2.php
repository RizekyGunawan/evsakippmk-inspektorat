<!DOCTYPE html>
<html lang="en">

<body class="hold-transition sidebar-mini">
<div class="wrapper">
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-">
          <div class="col-sm-5 col-7">
            <h1>Dokumen Evaluasi</h1>
          </div>
          <div class="col-sm-7 col-5">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dokumen Evaluasi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
             <div class="card-header d-flex p-0 col-md-12">
                 <ul class="nav nav-pills ml-3 p-3">
                  <li class="nav-item"> 
                    
                
        </li>
        </ul>

              </div>
              
            


              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="table" style="width: 100%;" class="table table-bordered">
                  <thead class="thead-dark">
                    <tr>
                      <th class="text-center align-middle" style="width: 10px">No</th>
                      <th class="text-center align-middle">Kode Unit</th>
                      <th class="text-center align-middle">Nama Unit</th>
                      <!-- Kolom Status Pengisian - Menampilkan Draft/Selesai berdasarkan progres -->
                      <th class="text-center align-middle" style="width: 120px">Status Pengisian</th>
                      <th class="text-center align-middle" style="width: 120px">Status Evaluasi</th>
                      <th class="text-center align-middle" style="width: 200px">Laporan Evaluasi Final <?php echo $this->session->userdata('tahun'); ?></th>
                    </tr>
                  </thead>
                  
                  <?php if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "5"): ?>
                  <tbody>

                  <?php
                     $no = 1;
                     foreach ($unit3 as $unt) : ?>
                    <tr>
                      <td class="text-center"><?php echo $no++ ?> </td>
                      <td class="text-center"><?php echo $unt['kd_unit']; ?></td>
                      <td style="width: 900px"><?php echo $unt['nm_unit']; ?></td>
                 
                      <!-- Status Pengisian: Menampilkan Draft (data belum lengkap) atau Selesai (data lengkap) -->
                      <!-- Catatan: Status ditentukan dari keberadaan file Laporan Evaluasi -->
                      <td class="text-center" style="width: 120px">
                        <?php 
                          // Jika ada file Laporan, status Selesai, jika tidak maka Draft
                          if (!empty($unt['lap_ev'])) {
                            echo '<span class="badge badge-success">Selesai</span>';
                          } else {
                            echo '<span class="badge badge-warning">Draft</span>';
                          }
                        ?>
                      </td>
                      <td class="text-center"><?php 
                        if ($unt['status_data1'] == "0"){echo "Draft";} elseif ($unt['status_data1'] == "1"){echo "Final";} else {echo "";}; ?></td>

                      <!-- Kolom Laporan Evaluasi - Dipindah ke paling kanan -->
                      <td class="text-center align-middle">
                        <?php if ($unt['lap_ev'] != ""): ?>
                          <!-- Tombol Preview -->
                          <a class="btn btn-info btn-sm mr-1" href="../assets/dok_ev/<?php echo $unt['lap_ev']; ?>" target="_blank">
                            <i class="fas fa-eye"></i> Preview
                          </a>
                          <!-- Tombol Download -->
                          <a class="btn btn-success btn-sm" href="../assets/dok_ev/<?php echo $unt['lap_ev']; ?>" download>
                            <i class="fas fa-download"></i> Download
                          </a>
                        <?php else: ?>
                          <span class="badge badge-secondary">Belum Tersedia</span>
                        <?php endif; ?>
                      </td>

                       
                    </tr>
                   <?php endforeach; ?>

                  </tbody>
                <?php endif; ?>


                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                 
                </ul>
              </div>
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
          

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



</body>
</html>




