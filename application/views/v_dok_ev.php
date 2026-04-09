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
                      <a class="btn btn-info btn-sm mr-2" href="<?php echo base_url('dok_ev/dashboard_rekap') ?>">
                        <i class="fas fa-chart-bar"></i> Dashboard Rekap
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="btn btn-success btn-sm" href="<?php echo base_url('dok_ev/perbandingan') ?>">
                        <i class="fas fa-chart-line"></i> Perbandingan &amp; Predikat
                      </a>
                    </li>
                  </ul>

                </div>


                <?php
                // Flash messages
                $flash_success = $this->session->flashdata('success');
                $flash_error = $this->session->flashdata('error');
                if ($flash_success): ?>
                  <div class="alert alert-success alert-dismissible mx-3 mt-3 mb-0">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-check-circle mr-1"></i><?php echo $flash_success; ?>
                  </div>
                <?php endif; ?>
                <?php if ($flash_error): ?>
                  <div class="alert alert-danger alert-dismissible mx-3 mt-3 mb-0">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-exclamation-circle mr-1"></i><?php echo $flash_error; ?>
                  </div>
                <?php endif; ?>

                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table id="table" style="width: 100%;" class="table table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th class="text-center align-middle" style="width: 10px">No</th>
                        <th class="text-center align-middle">Kode Unit</th>
                        <th class="text-center align-middle">Nama Unit</th>
                        <th class="text-center align-middle">Progres Kriteria</th>
                        <th class="text-center align-middle">Nilai Eva</th>
                        <!-- Kolom Status Pengisian - Menampilkan Draft/Selesai berdasarkan progres -->
                        <th class="text-center align-middle" style="width: 120px">Status Pengisian</th>
                        <th class="text-center align-middle" style="width: 120px">Status Evaluasi</th>
                        <th class="text-center align-middle" style="width: 140px">Laporan Evaluasi</th>
                        <!-- Kolom Aksi tersedia untuk semua role -->
                        <th class="text-center align-middle">Aksi</th>
                      </tr>
                    </thead>

                    <!-- Section 1: Tersedia untuk semua role -->
                    <tbody>

                      <?php
                      $no = 1;
                      $id_role_v = (int) $this->session->userdata('id_role');
                      foreach ($unit3monev2 as $unt): ?>
                        <tr>
                          <td class="text-center"><?php echo $no++ ?> </td>
                          <td title="<?php echo $unt['nm_unit']; ?>" class="text-center"><?php echo $unt['kd_unit']; ?>
                          </td>
                          <td style="width: 800px"><?php echo $unt['nm_unit']; ?></td>
                          <td class="text-center" style="width: 120px">
                            <?php $format = number_format((float) $unt['persen'], 2, ",", ".");
                            echo $format; ?>%
                          </td>
                          <td class="text-center" style="width: 120px">
                            <?php $format = number_format((float) $unt['totalnilai'], 2, ",", ".");
                            echo $format; ?>
                          </td>
                          <!-- Status Pengisian: Otomatis berdasarkan progres kriteria -->
                          <td class="text-center" style="width: 120px">
                            <?php
                            $progres = (float) $unt['persen'];
                            if ($progres >= 100) {
                              echo '<span class="badge badge-success">Selesai</span>';
                            } else {
                              echo '<span class="badge badge-warning">Draft</span>';
                            }
                            ?>
                          </td>
                          <td class="text-center">
                            <?php
                            if ($unt['status_data1'] == "0") {
                              echo "Draft";
                            } elseif ($unt['status_data1'] == "1") {
                              echo "Final";
                            } else {
                              echo "";
                            }
                            ; ?>
                          </td>

                          <!-- Kolom Laporan Evaluasi -->
                          <td class="text-center align-middle" style="width: 140px">
                            <?php if (!empty($unt['lap_ev'])): ?>
                              <a class="btn btn-info btn-xs" href="../assets/dok_ev/<?php echo $unt['lap_ev']; ?>"
                                target="_blank" title="Lihat laporan">
                                <i class="fas fa-eye mr-1"></i>Preview
                              </a>
                            <?php else: ?>
                              <span class="text-muted small">—</span>
                            <?php endif; ?>
                          </td>

                          <td class="text-center align-middle" style="width:90px;">
                            <div class="d-flex justify-content-center align-items-center" style="gap:4px;">

                              <!-- Tombol Edit Status: semua role -->
                              <div class="btn btn-success btn-xs" data-toggle="modal"
                                data-target="#EditData<?php echo $unt['id_dok_ev']; ?>" title="Ubah Status Evaluasi">
                                <i class="fas fa-edit"></i>
                              </div>

                              <?php if (in_array($id_role_v, [3, 10, 11, 12, 13])): ?>
                                <?php
                                $can_upload = ($id_role_v === 11 && $unt['status_data1'] == '1');
                                if ($can_upload) {
                                  $btn_title = 'Upload Laporan Evaluasi';
                                } elseif ($id_role_v === 11) {
                                  $btn_title = 'Upload tersedia setelah status Final';
                                } else {
                                  $btn_title = 'Hanya Pengendali Teknis yang dapat melakukan upload';
                                }
                                ?>
                                <?php if ($can_upload): ?>
                                  <div class="btn btn-warning btn-xs" data-toggle="modal"
                                    data-target="#UploadLap<?php echo $unt['id_dok_ev']; ?>"
                                    title="<?php echo $btn_title; ?>">
                                    <i class="fas fa-upload"></i>
                                  </div>
                                <?php else: ?>
                                  <div class="btn btn-secondary btn-xs"
                                    style="cursor:not-allowed; opacity:0.45; pointer-events:none;"
                                    title="<?php echo $btn_title; ?>">
                                    <i class="fas fa-upload"></i>
                                  </div>
                                <?php endif; ?>
                              <?php endif; ?>

                            </div>
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





    <!-- Modal Edit Status Evaluasi -->
    <?php $no = 0;
    foreach ($unit3monev as $unt): ?>
      <div class="modal fade" id="EditData<?php echo $unt['id_dok_ev']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ubah Status Evaluasi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">

              <?php echo form_open_multipart('dok_ev/update_data'); ?>


              <input type="hidden" name="id_dok_ev" value="<?php echo $unt['id_dok_ev']; ?>">



              <div class="row">
                <div class="form-group col-md-12">
                  <label for="inputState">Status Evaluasi</label>
                  <select id="inputState" name="status_data1" class="form-control" value="<?php
                  if ($unt['status_data1'] == "0") {
                    echo "Draft";
                  } elseif ($unt['status_data1'] == "1") {
                    echo "Final";
                  } else {
                    echo "";
                  }
                  ; ?>">
                    <option hidden="true" value="<?php echo $unt['status_data1']; ?>">
                      <?php
                      if ($unt['status_data1'] == "0") {
                        echo "Draft";
                      } elseif ($unt['status_data1'] == "1") {
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
            </div>


          </div>
        </div>
      </div>
    <?php endforeach; ?>


    <!-- Modal Upload Laporan Evaluasi — hanya dirender untuk Pengendali Teknis (role 11) -->
    <?php if ((int) $this->session->userdata('id_role') === 11): ?>
      <?php foreach ($unit3monev as $unt): ?>
        <div class="modal fade" id="UploadLap<?php echo $unt['id_dok_ev']; ?>" tabindex="-1" role="dialog"
          aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">
                  <i class="fas fa-upload mr-1"></i>Upload Laporan Evaluasi
                </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
              </div>
              <div class="modal-body">
                <p class="text-muted small mb-2">
                  <i class="fas fa-info-circle mr-1"></i>
                  Unit: <strong><?php echo htmlspecialchars($unt['nm_unit'] ?? '', ENT_QUOTES); ?></strong>
                </p>
                <?php echo form_open_multipart('dok_ev/update_data2'); ?>
                <input type="hidden" name="id_dok_ev" value="<?php echo $unt['id_dok_ev']; ?>">
                <div class="form-group">
                  <label>File Laporan <span class="text-muted small">(PDF, maks. 15 MB)</span></label>
                  <input type="file" name="lap_ev" class="form-control-file" accept=".pdf" required>
                </div>
                <?php if (!empty($unt['lap_ev'])): ?>
                  <p class="text-muted small">
                    <i class="fas fa-check-circle text-success mr-1"></i>
                    File aktif: <code><?php echo htmlspecialchars($unt['lap_ev'], ENT_QUOTES); ?></code><br>
                    <span class="text-warning">Upload baru akan menggantikan file tersebut.</span>
                  </p>
                <?php endif; ?>
                <div class="mt-3">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-upload mr-1"></i>Upload
                  </button>
                </div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>



</body>

</html>