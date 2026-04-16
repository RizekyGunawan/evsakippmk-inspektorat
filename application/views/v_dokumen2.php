<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tablesort/5.2.1/tablesort.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tablesort/5.2.1/sorts/tablesort.number.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Tablesort.extend('number', function (item) {
        return item.match(/^-?\d+[,\.]?\d*$/);
      }, function (a, b) {
        return parseFloat(a.replace(/,/g, '').replace('%', '')) - parseFloat(b.replace(/,/g, '').replace('%', ''));
      });

      Tablesort.extend('percentage', function (item) {
        return item.match(/^\d+(\.\d+)?%$/);
      }, function (a, b) {
        return parseFloat(a.replace('%', '')) - parseFloat(b.replace('%', ''));
      });

      new Tablesort(document.getElementById('table'));
    });
  </script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-">
            <div class="col-sm-5 col-7">
              <h1>Dokumen Self Assessment</h1>
            </div>
            <div class="col-sm-7 col-5">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dokumen Self Assessment</li>
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
                      <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 7 || $this->session->userdata('id_role') == 6)): ?>
                        <a class="btn btn-success" href="<?php echo base_url('dokumen/excelnilai') ?>"><i
                            class="fas fa-file-excel"></i> Nilai & Status</a>
                      <?php endif; ?>
                      <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 7 || $this->session->userdata('id_role') == 6)): ?>
                        <a class="btn btn-success" href="<?php echo base_url('dokumen/excelkomp') ?>"><i
                            class="fas fa-file-excel"></i> Komponen</a>
                      <?php endif; ?>
                      <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 7 || $this->session->userdata('id_role') == 6)): ?>
                        <a class="btn btn-success" href="<?php echo base_url('dokumen/excelsub') ?>"><i
                            class="fas fa-file-excel"></i> Subkomponen</a>
                      <?php endif; ?>
                      <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 7 || $this->session->userdata('id_role') == 6)): ?>
                        <a class="btn btn-success" href="<?php echo base_url('dokumen/excelkriteria') ?>"><i
                            class="fas fa-file-excel"></i> Kriteria</a>
                      <?php endif; ?>

                      <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 9)): ?>
                        <a href="#" class="btn btn-danger ml-2" data-toggle="modal" data-target="#ResetDataModal" title="Reset Tabel Penilaian Mandiri"><i class="fas fa-trash-restore"></i> Reset Data PM Khusus</a>
                      <?php endif; ?>
                    </li>
                  </ul>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table id="table" style="width: 100%;" class="table table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th class="text-center align-middle" style="width: 10px">No</th>
                        <th class="text-center align-middle" colspan="6">Nama Unit</th>
                        <th class="text-center align-middle">Progres Kriteria</th>
                        <th class="text-center align-middle">Nilai SA</th>
                        <!-- <th class="text-center align-middle" style="width: 120px">Laporan SA Final <?php echo $this->session->userdata('tahun'); ?></th> -->
                        <th class="text-center align-middle" style="width: 120px">Status SA</th>
                        <th class="text-center align-middle">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($unit3monev2 as $unt): ?>
                        <tr>
                          <td class="text-center">
                            <?php echo $no++ ?>
                          </td>
                          <td style="width: 120px" colspan="6">
                            <?php echo $unt['nm_unit']; ?>
                          </td>
                          <td class="text-center" style="width: 120px">
                            <?php $format = number_format((float) $unt['persen'], 2, ",", ".");
                            echo $format; ?>%
                          </td>
                          <td class="text-center" style="width: 120px">
                            <?php $format = number_format((float) $unt['totalnilai'], 2, ",", ".");
                            echo $format; ?>
                          </td>

                          <!-- <td class="text-center align-middle" style="width: 30px">
                            <?php //if ($unt['dok_lap'] != ""): ?>
                              <a class="btn btn-secondary btn-xs" href="../assets/laporan/<?php //echo $unt['dok_lap']; ?>" target="_blank">Preview</a>
                            <?php //endif; ?>
                          </td> -->

                          <td class="text-center">
                            <?php
                            if ($unt['status_data'] == "0") {
                              echo "Draft";
                            } elseif ($unt['status_data'] == "1") {
                              echo "Final";
                            } else {
                              echo "";
                            }
                            ;
                            ?>
                          </td>
                          <td class="text-center align-middle" style="width: 30px">
                            <?php
                            $role = (int) $this->session->userdata('id_role');
                            $is_admin = in_array($role, [4, 9]);
                            // Semua role yang memiliki akses pemantauan dokumen (mencakup 2,3,6,7,10,11,12)
                            $is_evaluator = in_array($role, [2, 3, 6, 7, 10, 11, 12, 13]);

                            if ($is_admin || $is_evaluator):
                              ?>
                              <div class="btn btn-success btn-xs" data-toggle="modal"
                                data-target="#EditData<?php echo $unt['id_dokumen']; ?>"><i class="fas fa-edit"></i></div>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
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

    <!-- Modal Edit -->
    <?php $no = 0;
    foreach ($unit3monev2 as $unt):
      $id_dokumen = $unt['id_dokumen'];
      $tahun = $this->session->userdata('tahun');

      // Query untuk memeriksa jawaban0
      $ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';
      $query_jawaban0 = "SELECT c.kd_subkomponen, jawaban0,
  (CASE 
      WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 90 THEN 'AA'
      WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 80 THEN 'A'
      WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 70 THEN 'BB'
      WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 60 THEN 'B'
      WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 50 THEN 'CC'
      WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 30 THEN 'C'
      WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) > 0  THEN 'D'
      WHEN ((avg(c.bobot2*NULLIF(a.jawaban1, ''))/c.bobot2)) = 0  THEN 'E'
  ELSE ''
  END) as jawabanantara
  FROM ta_pm a INNER JOIN $ref_aspek_table b ON a.id_aspek=b.id_aspek INNER JOIN ref_subkomponen c ON a.id_subkomponen=c.id_subkomponen INNER JOIN ta_pm0 d ON a.id_pm0=d.id_pm0 WHERE a.id_dokumen = $id_dokumen GROUP BY a.id_pm0";
      $result_jawaban0 = $this->db->query($query_jawaban0);
      $rows_jawaban0 = $result_jawaban0->result();

      // Query untuk memeriksa jawaban1
      $query_jawaban1 = "SELECT jawaban1 FROM ta_pm WHERE id_dokumen = $id_dokumen";
      $result_jawaban1 = $this->db->query($query_jawaban1);
      $rows_jawaban1 = $result_jawaban1->result();

      // Inisialisasi variabel untuk memeriksa apakah ada empty string
      $has_empty_jawaban0 = false;
      $has_empty_jawaban1 = false;
      $has_mismatch = false;
      $mismatched_details = [];

      // Periksa apakah ada empty string di jawaban1
      foreach ($rows_jawaban1 as $row) {
        if ($row->jawaban1 === '') {
          $has_empty_jawaban1 = true;
          break;
        }
      }

      // Periksa apakah ada empty string di jawaban0
      foreach ($rows_jawaban0 as $row) {
        if ($row->jawaban0 === '') {
          $has_empty_jawaban0 = true;
          break;
        }
        $is_mismatch = false;
        // Validasi jawaban0 dengan jawabanantara
        switch ($row->jawaban0) {
          case '100':
            if ($row->jawabanantara !== 'AA')
              $is_mismatch = true;
            break;
          case '90':
            if ($row->jawabanantara !== 'A')
              $is_mismatch = true;
            break;
          case '80':
            if ($row->jawabanantara !== 'BB')
              $is_mismatch = true;
            break;
          case '70':
            if ($row->jawabanantara !== 'B')
              $is_mismatch = true;
            break;
          case '60':
            if ($row->jawabanantara !== 'CC')
              $is_mismatch = true;
            break;
          case '50':
            if ($row->jawabanantara !== 'C')
              $is_mismatch = true;
            break;
          case '30':
            if ($row->jawabanantara !== 'D')
              $is_mismatch = true;
            break;
          case '0':
            if ($row->jawabanantara !== 'E')
              $is_mismatch = true;
            break;
          default:
            $is_mismatch = true;
            break;
        }
        if ($is_mismatch) {
          $has_mismatch = true;
          $jawaban0_mapped = $row->jawaban0;
          if ($row->jawaban0 == '100')
            $jawaban0_mapped = 'AA';
          if ($row->jawaban0 == '90')
            $jawaban0_mapped = 'A';
          if ($row->jawaban0 == '80')
            $jawaban0_mapped = 'BB';
          if ($row->jawaban0 == '70')
            $jawaban0_mapped = 'B';
          if ($row->jawaban0 == '60')
            $jawaban0_mapped = 'CC';
          if ($row->jawaban0 == '50')
            $jawaban0_mapped = 'C';
          if ($row->jawaban0 == '30')
            $jawaban0_mapped = 'D';
          if ($row->jawaban0 == '0')
            $jawaban0_mapped = 'E';
          $mismatched_details[] = $row->kd_subkomponen . " (Akhir: " . $jawaban0_mapped . " vs Antara: " . $row->jawabanantara . ")";
        }
      }
      ?>
      <div class="modal fade" id="EditData<?php echo $unt['id_dokumen']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ubah Status SA</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <?php if ($has_empty_jawaban0 || $has_empty_jawaban1 || $has_mismatch): ?>
                <div class="alert alert-danger text-justify">
                  <?php if ($has_empty_jawaban0 || $has_empty_jawaban1): ?>
                    <i class="fas fa-exclamation-triangle"></i> Masih terdapat jawaban pada Subkomponen dan/atau Kriteria yang
                    belum terisi. Harap lengkapi pengisian jawaban sebelum mengubah status ke Final.
                    <br>
                  <?php endif; ?>
                  <?php if ($has_mismatch): ?>
                    <i class="fas fa-exclamation-triangle"></i> Masih terdapat Jawaban Akhir pada Subkomponen yang tidak
                    sesuai dengan Jawaban Antara:
                    <ul class="mb-0 mt-1 pl-3 text-sm">
                      <?php foreach ($mismatched_details as $md): ?>
                        <li>
                          <?php echo $md; ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                    <br>Harap masuk ke menu Pengisian Penilaian lalu tekan Save pada form Subkomponen tersebut agar nilainya
                    terupdate otomatis.
                  <?php endif; ?>
                </div>
              <?php else: ?>
                <?php echo form_open_multipart('dokumen/update_data', 'onsubmit="return validateForm2(this);"'); ?>
                <input type="hidden" name="id_dokumen" value="<?php echo $unt['id_dokumen']; ?>">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="inputState">Status SA</label>
                    <select id="inputState" name="status_data" class="form-control">
                      <option hidden="true" value="<?php echo $unt['status_data']; ?>">
                        <?php if ($unt['status_data'] == "0") {
                          echo "Draft";
                        } elseif ($unt['status_data'] == "1") {
                          echo "Final";
                        } else {
                          echo "";
                        }
                        ; ?>
                      </option>
                      <option value="0">Draft</option>
                      <option value="1">Final</option>
                    </select>
                  </div>
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>

                <?php echo form_close(); ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <script>
      function validateForm2(form) {
        if (form.status_data.value == '1') {
          if (!confirm('Apakah Anda yakin ingin mengubah status ke Final? Pastikan semua data sudah terisi dengan benar.')) {
            return false;
          }
        }
        return true;
      }
    </script>

    </script>

    <!-- Modal Reset Data PM -->
    <div class="modal fade" id="ResetDataModal" tabindex="-1" role="dialog" aria-labelledby="ResetDataModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h5 class="modal-title" id="ResetDataModalLabel"><i class="fas fa-exclamation-triangle"></i> Reset Data Penilaian Mandiri</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php echo form_open('dokumen/reset_data', 'onsubmit="return confirm(\'PERINGATAN! Anda yakin akan mereset form? Semua isian dan dokumen Laporan untuk Unit/Tahun terpilih akan DIBERSIHKAN PERMANEN.\');"'); ?>
            <div class="form-group">
              <label for="id_unit">Pilih Unit Kerja</label>
              <select name="id_unit" class="form-control" required>
                <option value="">-- Pilih Unit Kerja --</option>
                <?php foreach ($unit2 as $u): ?>
                  <option value="<?php echo $u['id_unit']; ?>"><?php echo $u['nm_unit']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            
            <div class="form-group">
              <label for="tahun">Tahun Evaluasi</label>
              <input type="number" name="tahun" class="form-control" value="<?php echo $this->session->userdata('tahun'); ?>" min="2020" max="2099" required>
              <small class="form-text text-muted">Akan membongkar data khusus di tahun yang ditentukan ini.</small>
            </div>

            <div class="alert alert-warning text-sm">
              Tindakan ini akan <b>mengahapus</b> seluruh tabel (`ta_pm`, `ta_pm0`, `ta_dokumen`) untuk Unit Kerja ini agar mereka mendapat form kosong seperti baru masuk pertama kali.
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Ya, Reset Sekarang</button>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

</body>

</html>