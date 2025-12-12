<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tablesort/5.2.1/tablesort.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tablesort/5.2.1/sorts/tablesort.number.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      Tablesort.extend('number', function(item) {
        return item.match(/^-?\d+[,\.]?\d*$/);
      }, function(a, b) {
        return parseFloat(a.replace(/,/g, '').replace('%', '')) - parseFloat(b.replace(/,/g, '').replace('%', ''));
      });

      Tablesort.extend('percentage', function(item) {
        return item.match(/^\d+(\.\d+)?%$/);
      }, function(a, b) {
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
                      <a class="btn btn-success" href="<?php echo base_url('dokumen/excelnilai') ?>"><i class="fas fa-file-excel"></i> Nilai & Status</a>
                    <?php endif; ?>
                    <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 7 || $this->session->userdata('id_role') == 6)): ?>
                      <a class="btn btn-success" href="<?php echo base_url('dokumen/excelkomp') ?>"><i class="fas fa-file-excel"></i> Komponen</a>
                    <?php endif; ?>
                    <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 7 || $this->session->userdata('id_role') == 6)): ?>
                      <a class="btn btn-success" href="<?php echo base_url('dokumen/excelsub') ?>"><i class="fas fa-file-excel"></i> Subkomponen</a>
                    <?php endif; ?>
                    <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 7 || $this->session->userdata('id_role') == 6)): ?>
                      <a class="btn btn-success" href="<?php echo base_url('dokumen/excelkriteria') ?>"><i class="fas fa-file-excel"></i> Kriteria</a>
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
                      <th class="text-center align-middle" >Kode Unit</th>
                      <th class="text-center align-middle" colspan="6">Nama Unit</th>
                      <th class="text-center align-middle">Progres Kriteria</th>
                      <th class="text-center align-middle">Nilai SA</th>
                      <!-- <th class="text-center align-middle" style="width: 120px">Laporan SA Final <?php echo $this->session->userdata('tahun'); ?></th> -->
                      <th class="text-center align-middle" style="width: 120px">Status SA</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach ($unit3monev2 as $unt) : ?>
                        <tr>
                          <td class="text-center"><?php echo $no++ ?> </td>
                          <td class="text-center" style="width: 120px"><?php echo $unt['kd_unit']; ?></td>
                          <td style="width: 120px" colspan="6"><?php echo $unt['nm_unit']; ?></td>
                          <td class="text-center" style="width: 120px"><?php $format = number_format((float)$unt['persen'],2,",","."); echo $format; ?>%</td> 
                          <td class="text-center" style="width: 120px"><?php $format = number_format((float)$unt['totalnilai'],2,",","."); echo $format; ?></td> 
                          
                          <!-- <td class="text-center align-middle" style="width: 30px">
                            <?php //if ($unt['dok_lap'] != ""): ?>
                              <a class="btn btn-secondary btn-xs" href="../assets/laporan/<?php //echo $unt['dok_lap']; ?>" target="_blank">Preview</a>
                            <?php //endif; ?>
                          </td> -->

                          <td class="text-center">
                            <?php 
                              if ($unt['status_data'] == "0"){
                                echo "Draft";
                              } elseif ($unt['status_data'] == "1"){
                                echo "Final";
                              } else {
                                echo "";
                              }; 
                            ?>
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
</body>
</html>
