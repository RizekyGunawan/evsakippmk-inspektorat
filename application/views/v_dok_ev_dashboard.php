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
            <h1>Dashboard Rekap</h1>
          </div>
          <div class="col-sm-7 col-5">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dok_ev') ?>">Dokumen Evaluasi</a></li>
              <li class="breadcrumb-item active">Dashboard Rekap</li>
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
                <h3 class="card-title">NILAI PER KOMPONEN - Tahun <?php echo $this->session->userdata('tahun'); ?></h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                  <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th class="text-center align-middle" style="width: 50px">No</th>
                        <th class="text-center align-middle">Unit Kerja</th>
                        <th class="text-center align-middle" style="width: 100px">Perencanaan</th>
                        <th class="text-center align-middle" style="width: 100px">Pengukuran</th>
                        <th class="text-center align-middle" style="width: 100px">Pelaporan</th>
                        <th class="text-center align-middle" style="width: 100px">Evaluasi</th>
                        <th class="text-center align-middle" style="width: 100px">Nilai</th>
                        <th class="text-center align-middle" style="width: 80px">Kategori</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      // Group data by unit
                      $units_data = [];
                      $total_komp = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
                      $total_nilai = 0;
                      $count_units = 0;
                      
                      foreach ($datakomp as $row) {
                        $unit_id = $row['id_unit'];
                        $komp_id = $row['kd_komponen'];
                        
                        if (!isset($units_data[$unit_id])) {
                          $units_data[$unit_id] = [
                            'nm_unit' => $row['nm_unit'],
                            'komp' => [1 => 0, 2 => 0, 3 => 0, 4 => 0],
                            'total' => 0
                          ];
                        }
                        
                        $units_data[$unit_id]['komp'][$komp_id] = $row['nilaikomponen'];
                        $units_data[$unit_id]['total'] += $row['nilaikomponen'];
                        $total_komp[$komp_id] += $row['nilaikomponen'];
                      }
                      
                      $no = 1;
                      foreach ($units_data as $unit_id => $unit):
                        $total_nilai += $unit['total'];
                        $count_units++;
                        
                        // Determine kategori
                        $kategori = '';
                        if ($unit['total'] >= 90.01) $kategori = 'AA';
                        elseif ($unit['total'] >= 80.01) $kategori = 'A';
                        elseif ($unit['total'] >= 70.01) $kategori = 'BB';
                        elseif ($unit['total'] >= 60.01) $kategori = 'B';
                        elseif ($unit['total'] >= 50.01) $kategori = 'CC';
                        elseif ($unit['total'] >= 30.01) $kategori = 'C';
                        elseif ($unit['total'] >= 0.01) $kategori = 'D';
                        else $kategori = 'E';
                      ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td><?php echo $unit['nm_unit']; ?></td>
                        <td class="text-center"><?php echo number_format($unit['komp'][1], 2, ',', '.'); ?></td>
                        <td class="text-center"><?php echo number_format($unit['komp'][2], 2, ',', '.'); ?></td>
                        <td class="text-center"><?php echo number_format($unit['komp'][3], 2, ',', '.'); ?></td>
                        <td class="text-center"><?php echo number_format($unit['komp'][4], 2, ',', '.'); ?></td>
                        <td class="text-center"><strong><?php echo number_format($unit['total'], 2, ',', '.'); ?></strong></td>
                        <td class="text-center"><strong><?php echo $kategori; ?></strong></td>
                      </tr>
                      <?php endforeach; ?>
                      
                      <!-- Average Row -->
                      <tr style="background-color: #f0f0f0; font-weight: bold;">
                        <td colspan="2" class="text-center">Rata-Rata</td>
                        <td class="text-center"><?php echo number_format($total_komp[1] / $count_units, 2, ',', '.'); ?></td>
                        <td class="text-center"><?php echo number_format($total_komp[2] / $count_units, 2, ',', '.'); ?></td>
                        <td class="text-center"><?php echo number_format($total_komp[3] / $count_units, 2, ',', '.'); ?></td>
                        <td class="text-center"><?php echo number_format($total_komp[4] / $count_units, 2, ',', '.'); ?></td>
                        <td class="text-center"><?php echo number_format($total_nilai / $count_units, 2, ',', '.'); ?></td>
                        <td class="text-center">
                          <?php 
                          $avg = $total_nilai / $count_units;
                          if ($avg >= 90.01) echo 'AA';
                          elseif ($avg >= 80.01) echo 'A';
                          elseif ($avg >= 70.01) echo 'BB';
                          elseif ($avg >= 60.01) echo 'B';
                          elseif ($avg >= 50.01) echo 'CC';
                          elseif ($avg >= 30.01) echo 'C';
                          elseif ($avg >= 0.01) echo 'D';
                          else echo 'E';
                          ?>
                        </td>
                      </tr>
                      
                      <!-- Bobot Row -->
                      <tr style="background-color: #e0e0e0; font-weight: bold;">
                        <td colspan="2" class="text-center">Bobot</td>
                        <td class="text-center">30,00</td>
                        <td class="text-center">30,00</td>
                        <td class="text-center">15,00</td>
                        <td class="text-center">25,00</td>
                        <td colspan="2" class="text-center">100</td>
                      </tr>
                      
                      <!-- Pemenuhan Row -->
                      <tr style="background-color: #d0d0d0; font-weight: bold;">
                        <td colspan="2" class="text-center">Pemenuhan</td>
                        <td class="text-center"><?php echo number_format(($total_komp[1] / $count_units / 30) * 100, 2, ',', '.'); ?>%</td>
                        <td class="text-center"><?php echo number_format(($total_komp[2] / $count_units / 30) * 100, 2, ',', '.'); ?>%</td>
                        <td class="text-center"><?php echo number_format(($total_komp[3] / $count_units / 15) * 100, 2, ',', '.'); ?>%</td>
                        <td class="text-center"><?php echo number_format(($total_komp[4] / $count_units / 25) * 100, 2, ',', '.'); ?>%</td>
                        <td class="text-center"><?php echo number_format(($total_nilai / $count_units), 2, ',', '.'); ?>%</td>
                        <td class="text-center">-</td>
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
