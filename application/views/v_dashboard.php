
<!DOCTYPE html>
<html lang="en">
<head>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

 

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

         <!-- PM -->
        <?php if(($this->session->userdata('id_role') == 1) || $this->session->userdata('id_role') != 1 && $this->session->userdata('id_unit') != ""): ?>
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                
                <h3>
              <?php foreach ($statusunit as $sunit): ?>
              <?php if($sunit['status_data'] == 1): ?>
                Final
              <?php endif; ?>
              <?php if($sunit['status_data'] == 0): ?>
                Draft
              <?php endif; ?>
              <?php endforeach; ?>
              <?php if (empty($statusunit)): ?>
               Belum Input
              <?php endif; ?>
                </h3>
              

                <p>Status Pengisian Penilaian</p>
              </div>
              <div class="icon">
                <i class="ion ion-flag"></i>
              </div>
              <a href="<?php echo base_url() ?>dokumen/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php foreach ($persensub as $persub): ?>
                <h3><?php $format = number_format((float)$persub['jumlah'],0,",","."); echo $format; ?> dari 12 (<?php $format = number_format((float)$persub['persen'],2,",","."); echo $format; ?><sup style="font-size: 20px">%</sup>)</h3>
                <?php endforeach; ?>

                <p>Subkomponen telah dinilai</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url() ?>pm/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php foreach ($persenkriteria as $perkrit): ?>
                <h3><?php $format = number_format((float)$perkrit['jumlah'],0,",","."); echo $format; ?> dari 
                  <?php if($this->session->userdata('tahun') >= 2024): ?>
                  79
                  <?php endif; ?> 
                  <?php if($this->session->userdata('tahun') <= 2023): ?>
                  80
                  <?php endif; ?> 
                  (<?php $format = number_format((float)$perkrit['persen'],2,",","."); echo $format; ?><sup style="font-size: 20px">%</sup>)</h3>
                <?php endforeach; ?>

                <p>Kriteria telah dinilai</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url() ?>pm/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
        </div>

        <?php foreach ($statusunit as $sunit): ?>
        <?php if($sunit['status_data'] == 1): ?>
          
        <!-- Evaluasi -->

        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                
                <h3>
              <?php foreach ($statusunitev as $sunitev): ?>
              <?php if($sunitev['status_data1'] == 1): ?>
                Final
              <?php endif; ?>
              <?php if(!empty($blminiputevunit) && $sunitev['status_data1'] == 0): ?>
                Draft
              <?php endif; ?>
              <?php endforeach; ?>
              <?php if (empty($blminiputevunit)): ?>
               Belum Input
              <?php endif; ?>
                </h3>
                
              

                <p>Status Evaluasi</p>
              </div>
              <div class="icon">
                <i class="ion ion-flag"></i>
              </div>
              <a href="<?php echo base_url() ?>dok_ev/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php foreach ($persensubev as $persubev): ?>
                <h3><?php $format = number_format((float)$persubev['jumlah'],0,",","."); echo $format; ?> dari 12 (<?php $format = number_format((float)$persubev['persen'],2,",","."); echo $format; ?><sup style="font-size: 20px">%</sup>)</h3>
                <?php endforeach; ?>

                <p>Subkomponen telah dievaluasi</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url() ?>ev/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php foreach ($persenkriteriaev as $perkritev): ?>
                <h3><?php $format = number_format((float)$perkritev['jumlah'],0,",","."); echo $format; ?> dari 
                  <?php if($this->session->userdata('tahun') >= 2024): ?>
                  79
                  <?php endif; ?> 
                  <?php if($this->session->userdata('tahun') <= 2023): ?>
                  80
                  <?php endif; ?>  
                  (<?php $format = number_format((float)$perkritev['persen'],2,",","."); echo $format; ?><sup style="font-size: 20px">%</sup>)</h3>
                <?php endforeach; ?>

                <p>Kriteria telah dievaluasi</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url() ?>ev/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo count($konfirmasi0); ?></h3>

                <p>Subkomponen perlu dikonfirmasi</p>
              </div>
              <div class="icon">
                <i class="ion ion-alert"></i>
              </div>
              <a href="<?php echo base_url() ?>ev/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo count($konfirmasi02); ?></h3>

                <p>Subkomponen telah dikonfirmasi</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="<?php echo base_url() ?>ev/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo count($konfirmasi); ?></h3>

                <p>Kriteria perlu dikonfirmasi</p>
              </div>
              <div class="icon">
                <i class="ion ion-alert"></i>
              </div>
              <a href="<?php echo base_url() ?>ev/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo count($konfirmasi2); ?></h3>

                <p>Kriteria telah dikonfirmasi</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="<?php echo base_url() ?>ev/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
         <?php endif; ?>
         <?php endforeach; ?>

         <?php foreach ($statusunitev as $sunitev): ?>
                <?php if($sunitev['status_data1'] == 1): ?>
               
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php foreach ($rekomendasi as $rekom): ?>
                <h3><?php echo $rekom['jumlah']; ?>
                </h3>
              <?php endforeach; ?>

                <p>Rekomendasi</p>
              </div>
              <div class="icon">
                <i class="ion ion-document-text"></i>
              </div>
              <a href="<?php echo base_url() ?>rekomendasi/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php foreach ($tl as $tl): ?>
                <h3><?php echo $tl['jumlah']; ?></h3>
                <?php endforeach; ?>

                <p>Telah ditindaklanjuti</p>
              </div>
              <div class="icon">
                <i class="ion ion-reply-all"></i>
              </div>
              <a href="<?php echo base_url() ?>tl/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          
         
        </div>

         <?php endif; ?>
         <?php endforeach; ?>

      <?php endif; ?>
        <!-- /.row -->
        <!-- Main row -->
        
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <?php if($this->session->userdata('id_role') != 1 && $this->session->userdata('id_role') != 5): ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Status Pengisian Penilaian
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo base_url() ?>dokumen/index">Rincian</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="#sales-chart" data-toggle="tab">Chart</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="status-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <?php endif; ?>
            <!-- /.card -->

          
            <script>
                // Ambil data dari PHP dan ubah menjadi array JavaScript
                var status_data = <?php echo json_encode($status_data); ?>;

                // Hitung jumlah data dari status_data
                 var dataCount = <?php echo count($status_data); ?>;

                // Hitung jumlah data yang telah final (status = 1) dan belum final (status = 0)
                var finalCount = 0;
                var notFinalCount = 0;

                for (var i = 0; i < status_data.length; i++) {
                    if (status_data[i]['status_data'] === '1') {
                        finalCount++;
                    } else {
                        notFinalCount++;
                    }
                }

                // Konfigurasi grafik
                var config = {
                    type: 'pie',
                    data: {
                        labels: ['Final', 'Draft', 'Belum Input'],
                        datasets: [{
                            data: [finalCount, notFinalCount, 74 - dataCount],
                            backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(128, 128, 128, 0.2)'],
                            borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(128, 128, 128, 1)'],
                            borderWidth: 1
                        }]
                    },
                        options: {
                            responsive: true, // Untuk mengaktifkan responsivitas chart
                            maintainAspectRatio: false, // Untuk membiarkan chart mengisi seluruh ruang canvas
                            animation: {
                                  animateRotate: true,
                                  animateScale: true
                              },
                              plugins: {
                              datalabels: {
                                  color: '#000', // Warna teks data
                                  anchor: 'end', // Posisi tampilan data (start, center, end, atau auto)
                                  align: 'end', // Penyesuaian horizontal data (start, center, end, atau auto)
                                  offset: 2, // Jarak antara label dan sektor pie
                                  formatter: function(value, context) {
                                      return value; // Menampilkan nilai pada label
                                  }
                              }
                          }
                        }
                    };



                // Tampilkan grafik menggunakan Chart.js
                var ctx = document.getElementById('status-chart-canvas').getContext('2d');
                new Chart(ctx, config);
            </script>

           
              

            
        

            

          </section>
          <!-- right col -->
        
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <?php if($this->session->userdata('id_role') != 1 && $this->session->userdata('id_role') != 5): ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Status Evaluasi
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo base_url() ?>dok_ev/index">Rincian</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="#sales-chart2" data-toggle="tab">Chart</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="sales-chart2" style="position: relative; height: 300px;">
                    <canvas id="status-chart-canvas2" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <?php endif; ?>
            <!-- /.card -->


            
          
            <script>
                // Ambil data dari PHP dan ubah menjadi array JavaScript
                var status_dataev = <?php echo json_encode($status_dataev); ?>;

                // Hitung jumlah data dari status_data
                 var dataCount = <?php echo count($blminiputev); ?>;

                // Hitung jumlah data yang telah final (status = 1) dan belum final (status = 0)
                var finalCount = 0;
                var notFinalCount = 0;

                for (var i = 0; i < status_dataev.length; i++) {
                    if (status_dataev[i]['status_data1'] === '1') {
                        finalCount++;
                    } else {
                        notFinalCount++;
                    }
                }

                // Konfigurasi grafik
                var config = {
                    type: 'pie',
                    data: {
                        labels: ['Final', 'Draft', 'Belum Input'],
                        datasets: [{
                            data: [finalCount, dataCount - finalCount, 74 - dataCount],
                            backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(128, 128, 128, 0.2)'],
                            borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(128, 128, 128, 1)'],
                            borderWidth: 1
                        }]
                    },
                        options: {
                            responsive: true, // Untuk mengaktifkan responsivitas chart
                            maintainAspectRatio: false, // Untuk membiarkan chart mengisi seluruh ruang canvas
                            animation: {
                                  animateRotate: true,
                                  animateScale: true
                              },
                              plugins: {
                              datalabels: {
                                  color: '#000', // Warna teks data
                                  anchor: 'end', // Posisi tampilan data (start, center, end, atau auto)
                                  align: 'end', // Penyesuaian horizontal data (start, center, end, atau auto)
                                  offset: 2, // Jarak antara label dan sektor pie
                                  formatter: function(value, context) {
                                      return value; // Menampilkan nilai pada label
                                  }
                              }
                          }
                        }
                    };



                // Tampilkan grafik menggunakan Chart.js
                var ctx = document.getElementById('status-chart-canvas2').getContext('2d');
                new Chart(ctx, config);
            </script>

           
              

            
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">

         
          </section>
          <!-- right col -->


        </div>
        <!-- /.row (main row) -->


        

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  
</div>
<!-- ./wrapper -->



<!-- Modal Detail -->
<div class="modal fade" id="DetailData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rincian Status Unit Kerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
         <div class="container-fluid">
          <table  style="width: 100%;" class="table" >
               


              <thead>
                <tr>
                      <th class="align-middle" style="width: 10%">No</th>
                      <th class="align-middle" style="width: 10%">Kode Unit</th>
                      <th class="align-middle" style="width: 70%">Nama Unit</th>
                      <th class="align-middle" style="width: 10%">Status</th>
                    </tr>
              </thead>

                  <tbody>

                  <?php $no = 1; foreach ($statusrinci as $starin) : ?>
                    <tr>
                      
                      <td class="text-justify align-middle" style="width: 10%"><?php echo $no++ ?></td>
                      <td class="text-justify align-middle" style="width: 10%"><?php echo $starin['kd_unit']; ?></td>
                      <td class="text-justify align-middle" style="width: 70%"><?php echo $starin['nm_unit']; ?></td>
                      <td class="text-justify align-middle" style="width: 10%">
                         <?php if ($starin['status_data'] == "1"): ?>
                          Final
                              <?php endif; ?>
                              <?php if ($starin['status_data'] == "0"): ?>
                          Draft
                              <?php endif; ?>
                        </td>
                      
                    </tr>
                      <?php endforeach; ?>
                  </tbody>
                </table>

          

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
           
        </div>

      </div>

      
    </div>
  </div>
</div>



</body>
</html>
