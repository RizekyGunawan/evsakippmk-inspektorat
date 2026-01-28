<!DOCTYPE html>
<html lang="en">

<style>
  .komponen-row {
    background-color: #87CEEB !important;
    color: #000000 !important;
    font-weight: bold;
  }
  .subkomponen-row {
    background-color: #FFE4C4 !important;
    color: #000000 !important;
    font-weight: bold;
  }
  .kriteria-row {
    background-color: #FFFFE0 !important;
    color: #000000 !important;
  }
  .total-row {
    background-color: #1F4E78 !important;
    color: #FFFFFF !important;
    font-weight: bold;
  }
  .table-rekap {
    font-size: 12px;
    background-color: #FFFFFF !important;
  }
  .table-rekap td, .table-rekap th {
    padding: 6px 4px;
    vertical-align: middle;
    color: #000000 !important;
    background-color: #FFFFFF !important;
  }
  .table-rekap thead th {
    background-color: #343a40 !important;
    color: #FFFFFF !important;
  }
  /* Override untuk baris dengan class khusus */
  .table-rekap .komponen-row td {
    background-color: #87CEEB !important;
    color: #000000 !important;
  }
  .table-rekap .subkomponen-row td {
    background-color: #FFE4C4 !important;
    color: #000000 !important;
  }
  .table-rekap .kriteria-row td {
    background-color: #FFFFE0 !important;
    color: #000000 !important;
  }
  .table-rekap .total-row td {
    background-color: #1F4E78 !important;
    color: #FFFFFF !important;
  }
</style>

<body>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-">
          <div class="col-sm-5 col-7">
            <h1>Rekapitulasi Unit Kerja</h1>
          </div>
          <div class="col-sm-7 col-5">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rekapitulasi Unit Kerja</li>
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
                <h3 class="card-title">Nilai Gabungan Unit Kerja - Tahun <?php echo $this->session->userdata('tahun'); ?></h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body table-responsive p-0" style="max-height: 800px;">
                  <table class="table table-bordered table-hover table-rekap table-sm">
                    <thead class="thead-dark" style="position: sticky; top: 0; z-index: 10;">
                      <tr>
                        <th class="text-center align-middle" style="width: 50px">No</th>
                        <th class="text-center align-middle" style="width: 400px">Komponen/Sub Komponen/Kriteria</th>
                        <th class="text-center align-middle" style="width: 80px">Bobot</th>
                        <?php foreach ($rekap_units as $unit): ?>
                        <th class="text-center align-middle" style="width: 80px"><?php echo $unit['nm_unit']; ?></th>
                        <?php endforeach; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      // Group data by komponen, subkomponen, kriteria
                      $structured_data = [];
                      $units_list = [];
                      
                      // Get list of units
                      foreach ($rekap_units as $unit) {
                        $units_list[$unit['id_unit']] = $unit['nm_unit'];
                      }
                      
                      // Structure the detail data
                      if (!empty($rekap_detail)) {
                        foreach ($rekap_detail as $row) {
                          $komp_id = $row['id_komponen'];
                          $sub_id = $row['id_subkomponen'];
                          $asp_id = $row['id_aspek'];
                          $unit_id = $row['id_unit'];
                          
                          if (!isset($structured_data[$komp_id])) {
                            $structured_data[$komp_id] = [
                              'info' => $row,
                              'subkomponen' => []
                            ];
                          }
                          
                          if (!isset($structured_data[$komp_id]['subkomponen'][$sub_id])) {
                            $structured_data[$komp_id]['subkomponen'][$sub_id] = [
                              'info' => $row,
                              'units' => [],
                              'kriteria' => []
                            ];
                          }
                          
                          // Store subkomponen nilai per unit
                          if ($unit_id) {
                            $structured_data[$komp_id]['subkomponen'][$sub_id]['units'][$unit_id] = $row['nilai_subkomp'];
                          }
                          
                          // Store kriteria if exists
                          if ($asp_id) {
                            if (!isset($structured_data[$komp_id]['subkomponen'][$sub_id]['kriteria'][$asp_id])) {
                              $structured_data[$komp_id]['subkomponen'][$sub_id]['kriteria'][$asp_id] = [
                                'info' => $row,
                                'units' => []
                              ];
                            }
                            if ($unit_id) {
                              $structured_data[$komp_id]['subkomponen'][$sub_id]['kriteria'][$asp_id]['units'][$unit_id] = $row['jawaban2'];
                            }
                          }
                        }
                      }
                      
                      // Display the structured data
                      $no = 1;
                      foreach ($structured_data as $komp_id => $komp_data):
                        // Get komponen totals from rekap_units
                        $komp_field = 'komp' . $komp_id;
                      ?>
                      <!-- KOMPONEN ROW -->
                      <tr class="komponen-row">
                        <td class="text-center"><?php echo $komp_data['info']['kd_komponen']; ?></td>
                        <td><strong><?php echo $komp_data['info']['uraian_komponen']; ?></strong></td>
                        <td class="text-center"><?php echo number_format((float)$komp_data['info']['bobot_komponen'], 2, ',', '.'); ?></td>
                        <?php foreach ($rekap_units as $unit): ?>
                        <td class="text-center"><?php echo number_format((float)$unit[$komp_field], 2, ',', '.'); ?></td>
                        <?php endforeach; ?>
                      </tr>
                      
                      <?php foreach ($komp_data['subkomponen'] as $sub_id => $sub_data): ?>
                      <!-- SUBKOMPONEN ROW -->
                      <tr class="subkomponen-row">
                        <td class="text-center"><?php echo $sub_data['info']['kd_subkomponen']; ?></td>
                        <td><?php echo $sub_data['info']['uraian_subkomponen']; ?></td>
                        <td class="text-center"><?php echo number_format((float)$sub_data['info']['bobot_subkomponen'], 2, ',', '.'); ?></td>
                        <?php foreach ($units_list as $unit_id => $unit_name): ?>
                        <td class="text-center">
                          <?php 
                          if (isset($sub_data['units'][$unit_id])) {
                            echo number_format((float)$sub_data['units'][$unit_id], 2, ',', '.');
                          } else {
                            echo '-';
                          }
                          ?>
                        </td>
                        <?php endforeach; ?>
                      </tr>
                      
                      <?php 
                      // Display kriteria rows
                      if (!empty($sub_data['kriteria'])):
                        foreach ($sub_data['kriteria'] as $asp_id => $krit_data):
                      ?>
                      <!-- KRITERIA ROW -->
                      <tr class="kriteria-row">
                        <td class="text-center"><?php echo $krit_data['info']['kd_aspek']; ?></td>
                        <td style="padding-left: 20px;"><?php echo $krit_data['info']['uraian_aspek']; ?></td>
                        <td class="text-center">-</td>
                        <?php foreach ($units_list as $unit_id => $unit_name): ?>
                        <td class="text-center">
                          <?php 
                          if (isset($krit_data['units'][$unit_id])) {
                            $jawaban = $krit_data['units'][$unit_id];
                            if ($jawaban == '1') echo 'Ya';
                            elseif ($jawaban == '0') echo 'Tidak';
                            else echo '-';
                          } else {
                            echo '-';
                          }
                          ?>
                        </td>
                        <?php endforeach; ?>
                      </tr>
                      <?php 
                        endforeach;
                      endif;
                      ?>
                      
                      <?php endforeach; // End subkomponen loop ?>
                      
                      <?php endforeach; // End komponen loop ?>
                      
                      <!-- Total Row -->
                      <tr class="total-row">
                        <td colspan="2" class="text-center"><strong>NILAI AKUNTABILITAS KINERJA</strong></td>
                        <td class="text-center">100</td>
                        <?php foreach ($rekap_units as $unit): ?>
                        <td class="text-center"><?php echo number_format((float)$unit['total_nilai'], 2, ',', '.'); ?></td>
                        <?php endforeach; ?>
                      </tr>
                      
                      <!-- Predikat Row -->
                      <tr class="total-row">
                        <td colspan="3" class="text-center"><strong>PREDIKAT</strong></td>
                        <?php foreach ($rekap_units as $unit): 
                          $pemenuhan = (float)$unit['pemenuhan'];
                          $predikat = '';
                          
                          // Mapping berdasarkan nilai pasti sesuai tabel referensi
                          if ($pemenuhan == 100) {
                            $predikat = "AA";
                          } elseif ($pemenuhan >= 90 && $pemenuhan < 100) {
                            $predikat = "A";
                          } elseif ($pemenuhan >= 80 && $pemenuhan < 90) {
                            $predikat = "BB";
                          } elseif ($pemenuhan >= 70 && $pemenuhan < 80) {
                            $predikat = "B";
                          } elseif ($pemenuhan >= 60 && $pemenuhan < 70) {
                            $predikat = "CC";
                          } elseif ($pemenuhan >= 50 && $pemenuhan < 60) {
                            $predikat = "C";
                          } elseif ($pemenuhan >= 30 && $pemenuhan < 50) {
                            $predikat = "D";
                          } elseif ($pemenuhan > 0 && $pemenuhan < 30) {
                            $predikat = "D";
                          } elseif ($pemenuhan == 0) {
                            $predikat = "E";
                          }
                          // Format persentase dengan 2 desimal, koma sebagai pemisah desimal (format Indonesia)
                          $persentase_format = number_format($pemenuhan, 2, ',', '.');
                        ?>
                        <td class="text-center">
                          <?php echo $predikat; ?>
                        </td>
                        <?php endforeach; ?>
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
