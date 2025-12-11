<!DOCTYPE html>
<html lang="en">

<body>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-">
          <div class="col-sm-5 col-7">
            <h1>Perbandingan & Predikat</h1>
          </div>
          <div class="col-sm-7 col-5">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dok_ev') ?>">Dokumen Evaluasi</a></li>
              <li class="breadcrumb-item active">Perbandingan & Predikat</li>
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
              <div class="card-header">
                <h3 class="card-title">HASIL EVALUASI - Perbandingan Tahun <?php echo $this->session->userdata('tahun') - 1; ?> vs <?php echo $this->session->userdata('tahun'); ?></h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                  <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th class="text-center align-middle" style="width: 50px">No</th>
                        <th class="text-center align-middle">Unit Kerja</th>
                        <th class="text-center align-middle" style="width: 120px">Hasil Evaluasi<br><?php echo $this->session->userdata('tahun') - 1; ?></th>
                        <th class="text-center align-middle" style="width: 120px">Hasil Evaluasi<br><?php echo $this->session->userdata('tahun'); ?></th>
                        <th class="text-center align-middle" style="width: 80px">Predikat</th>
                        <th class="text-center align-middle" style="width: 120px">Kenaikan/<br>Penurunan</th>
                        <th class="text-center align-middle" style="width: 80px">%</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      $total_prev = 0;
                      $total_curr = 0;
                      $count = 0;
                      
                      foreach ($perbandingan as $row):
                        $tahun_prev = $this->session->userdata('tahun') - 1;
                        $tahun_curr = $this->session->userdata('tahun');
                        $nilai_prev = $row["nilai_$tahun_prev"];
                        $nilai_curr = $row["nilai_$tahun_curr"];
                        
                        $total_prev += $nilai_prev;
                        $total_curr += $nilai_curr;
                        $count++;
                        
                        // Determine predikat
                        $predikat = '';
                        if ($nilai_curr >= 90.01) $predikat = 'AA';
                        elseif ($nilai_curr >= 80.01) $predikat = 'A';
                        elseif ($nilai_curr >= 70.01) $predikat = 'BB';
                        elseif ($nilai_curr >= 60.01) $predikat = 'B';
                        elseif ($nilai_curr >= 50.01) $predikat = 'CC';
                        elseif ($nilai_curr >= 30.01) $predikat = 'C';
                        elseif ($nilai_curr >= 0.01) $predikat = 'D';
                        else $predikat = 'E';
                        
                        $selisih = $row['selisih'];
                        $persen = $row['persentase_perubahan'];
                        $color = $selisih > 0 ? 'text-success' : ($selisih < 0 ? 'text-danger' : '');
                      ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td><?php echo $row['nm_unit']; ?></td>
                        <td class="text-center"><?php echo number_format($nilai_prev, 2, ',', '.'); ?></td>
                        <td class="text-center"><?php echo number_format($nilai_curr, 2, ',', '.'); ?></td>
                        <td class="text-center"><strong><?php echo $predikat; ?></strong></td>
                        <td class="text-center <?php echo $color; ?>">
                          <strong><?php echo number_format($selisih, 2, ',', '.'); ?></strong>
                        </td>
                        <td class="text-center <?php echo $color; ?>">
                          <strong><?php echo number_format($persen, 2, ',', '.'); ?>%</strong>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                      
                      <!-- Average Row -->
                      <?php 
                      $avg_prev = $count > 0 ? $total_prev / $count : 0;
                      $avg_curr = $count > 0 ? $total_curr / $count : 0;
                      $avg_selisih = $avg_curr - $avg_prev;
                      $avg_persen = $avg_prev > 0 ? (($avg_selisih / $avg_prev) * 100) : 0;
                      $avg_color = $avg_selisih > 0 ? 'text-success' : ($avg_selisih < 0 ? 'text-danger' : '');
                      
                      $avg_predikat = '';
                      if ($avg_curr >= 90.01) $avg_predikat = 'AA';
                      elseif ($avg_curr >= 80.01) $avg_predikat = 'A';
                      elseif ($avg_curr >= 70.01) $avg_predikat = 'BB';
                      elseif ($avg_curr >= 60.01) $avg_predikat = 'B';
                      elseif ($avg_curr >= 50.01) $avg_predikat = 'CC';
                      elseif ($avg_curr >= 30.01) $avg_predikat = 'C';
                      elseif ($avg_curr >= 0.01) $avg_predikat = 'D';
                      else $avg_predikat = 'E';
                      ?>
                      <tr style="background-color: #f0f0f0; font-weight: bold;">
                        <td colspan="2" class="text-center">Rata-rata</td>
                        <td class="text-center"><?php echo number_format($avg_prev, 2, ',', '.'); ?></td>
                        <td class="text-center"><?php echo number_format($avg_curr, 2, ',', '.'); ?></td>
                        <td class="text-center"><?php echo $avg_predikat; ?></td>
                        <td class="text-center <?php echo $avg_color; ?>"><?php echo number_format($avg_selisih, 2, ',', '.'); ?></td>
                        <td class="text-center <?php echo $avg_color; ?>"><?php echo number_format($avg_persen, 2, ',', '.'); ?>%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              <!-- /.card-body -->
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
