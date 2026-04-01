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

                      <!-- <div <?php if ($this->session->userdata('id_unit') == "") {
                        echo "hidden";
                      } else {
                        echo "";
                      }
                      ; ?> class="col-">
                 <?php if (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5) && !empty($loadtu)): ?>
                 <?php foreach ($loadtu as $load): ?>
                <button type="button" class="btn btn-primary" <?php if ($load['id_dokumen'] == "") {
                  echo "";
                } elseif ($load['id_dokumen'] != "") {
                  echo "disabled";
                } else {
                  echo "disabled";
                }
                ; ?>
                      data-toggle="modal" data-target="<?php if ($load['id_dokumen'] == "") {
                        echo "#TambahData";
                      } elseif ($load['id_dokumen'] != "") {
                        echo "#";
                      } else {
                        echo "#";
                      }
                      ; ?>">
            Tambah Data
        </button>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </div> -->

                      <div <?php if ($this->session->userdata('id_unit') == "") {
                        echo "hidden";
                      } else {
                        echo "";
                      }
                      ; ?>
                        class="col-">
                        <?php if (($this->session->userdata('id_role') == 4) && !empty($loadtuall)): ?>
                          <?php foreach ($loadtuall as $loadall): ?>
                            <button type="button" class="btn btn-primary" <?php if ($loadall['id_dokumen'] == "") {
                              echo "";
                            } elseif ($loadall['id_dokumen'] != "") {
                              echo "disabled";
                            } else {
                              echo "disabled";
                            }
                            ; ?>
                              data-toggle="modal" data-target="<?php if ($loadall['id_dokumen'] == "") {
                                echo "#TambahDataAll";
                              } elseif ($loadall['id_dokumen'] != "") {
                                echo "#";
                              } else {
                                echo "#";
                              }
                              ; ?>">
                              Tambah Data Semua Unit
                            </button>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </div>

                    </li>
                  </ul>

                </div>




                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table id="table" style="width: 100%;" class="table table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th class="text-center align-middle" style="width: 10px">No</th>
                        <th class="text-center align-middle" colspan="7">Unit</th>
                        <!-- <th class="text-center align-middle" colspan="2" style="width: 120px">Laporan SA Final <?php //echo $this->session->userdata('tahun'); ?></th> -->
                        <th class="text-center align-middle" style="width: 120px">Status SA</th>
                        <th class="text-center align-middle">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $no = 1;
                      foreach ($unit3 as $unt): ?>
                        <tr>
                          <td class="text-center"><?php echo $no++ ?> </td>
                          <td class="text-center" style="width: 120px"><?php echo $unt['kd_unit']; ?></td>
                          <td style="width: 120px" colspan="6"><?php echo $unt['nm_unit']; ?></td>

                          <!-- <td class="text-center align-middle" style="width: 30px"> 
                           <?php
                           //  if ($unt['status_data'] == "0" && ((($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5) && ($this->session->userdata('id_unit') == $this->session->userdata('id_unit2') || 
                           //  $this->session->userdata('id_unit') == $this->session->userdata('id_unit_es1'))) || $this->session->userdata('id_role') == 4)): ?>
                          <div class= "btn btn-primary btn-xs" data-toggle="modal" data-target="#EditDatalap<?php echo $unt['id_dokumen']; ?>">Upload</div>
                       <?php
                       // endif; ?>
                     </td>

                     <td class="text-center align-middle" style="width: 30px">
                      <?php
                      // if ($unt['dok_lap'] != ""): ?>
                            <a class= "btn btn-secondary btn-xs" href="../assets/laporan/<?php echo $unt['dok_lap']; ?>" target="_blank">Preview</a>
                      <?php
                      // endif; ?>
                     </td>-->


                          <td class="text-center">
                            <?php
                            if ($unt['status_data'] == "0") {
                              echo "Draft";
                            } elseif ($unt['status_data'] == "1") {
                              echo "Final";
                            } else {
                              echo "";
                            }
                            ; ?>
                          </td>

                          <td class="text-center align-middle" style="width: 30px">
                            <?php
                            $role = (int) $this->session->userdata('id_role');
                            $is_admin = in_array($role, [4, 9]);
                            $is_unit_allowed = in_array($role, [1, 5, 14]) && ($this->session->userdata('id_unit') == $this->session->userdata('id_unit2') || $this->session->userdata('id_unit') == $this->session->userdata('id_unit_es1'));

                            if ($unt['status_data'] == "0" && ($is_admin || $is_unit_allowed)):
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






    <!-- Modal Tambah -->
    <div class="modal fade" id="TambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Dokumen Utama</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">

            <?php echo form_open_multipart('dokumen/tambah_data'); ?>


            <input hidden type="text" name="id_unit" class="form-control"
              value="<?php echo $this->session->userdata('id_unit'); ?>">
            <input hidden type="text" name="tahun" class="form-control"
              value="<?php echo $this->session->userdata('tahun'); ?>">





            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>

            <?php echo form_close(); ?>
          </div>


        </div>
      </div>
    </div>


    <!-- Modal Tambah All -->
    <div class="modal fade" id="TambahDataAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data All</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">

            <?php echo form_open_multipart('dokumen/tambah_dataall'); ?>


            <input hidden type="text" name="tahun" class="form-control"
              value="<?php echo $this->session->userdata('tahun'); ?>">





            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>

            <?php echo form_close(); ?>
          </div>


        </div>
      </div>
    </div>





    <!-- Modal Edit -->
    <?php $no = 0;
    foreach ($unit3 as $unt):
      $id_dokumen = $unt['id_dokumen'];
      $tahun = $this->session->userdata('tahun');

      // Query untuk memeriksa jawaban0
      $ref_aspek_table = ($tahun >= 2024) ? 'ref_aspek2' : 'ref_aspek';
      $query_jawaban0 = "SELECT jawaban0,
    (CASE 
    WHEN '100'=((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) THEN 'BB'
    WHEN '75'<((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) <='99' THEN 'B' 
    WHEN '50'<((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) <='75' THEN 'CC'
    WHEN '25'<((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) <='50' THEN 'C'  
    WHEN '0'<((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) && ((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) <='25' THEN 'D'
    WHEN '0'=((avg(c.bobot2*a.jawaban1)/c.bobot2)*100) THEN 'E'
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

      // Periksa apakah ada empty string di jawaban0
      foreach ($rows_jawaban1 as $row) {
        if ($row->jawaban1 === '') {
          $has_empty_jawaban1 = true;
          break;
        }
      }

      // Periksa apakah ada empty string di jawaban1
      foreach ($rows_jawaban0 as $row) {
        if ($row->jawaban0 === '') {
          $has_empty_jawaban0 = true;
          break;
        }
        // Validasi jawaban0 dengan jawabanantara
        switch ($row->jawaban0) {
          case '100':
          case '90':
          case '80':
            if ($row->jawabanantara !== 'BB')
              $has_mismatch = true;
            break;
          case '70':
            if ($row->jawabanantara !== 'B')
              $has_mismatch = true;
            break;
          case '60':
            if ($row->jawabanantara !== 'CC')
              $has_mismatch = true;
            break;
          case '50':
            if ($row->jawabanantara !== 'C')
              $has_mismatch = true;
            break;
          case '30':
            if ($row->jawabanantara !== 'D')
              $has_mismatch = true;
            break;
          case '0':
            if ($row->jawabanantara !== 'E')
              $has_mismatch = true;
            break;
        }
        if ($has_mismatch)
          break;
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
                    sesuai dengan Jawaban Antara. Harap periksa dan perbaiki jawaban tersebut.
                  <?php endif; ?>
                </div>
              <?php else: ?>
                <?php echo form_open_multipart('dokumen/update_data', 'onsubmit="return validateForm(this);"'); ?>
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
      // Fungsi untuk melakukan validasi sebelum submit form
      function validateForm(form) {
        // Ambil nilai status_data yang dipilih
        var statusData = form.status_data.value;

        // Lakukan validasi
        if (statusData == '1') {
          // Jika status_data dipilih Final, pastikan kolom jawaban sudah diisi
          // Validasi di sini hanya untuk memastikan form tidak di-submit jika status "Final"
          if (!confirm('Apakah Anda yakin ingin mengubah status ke Final? Pastikan semua data sudah terisi dengan benar.')) {
            return false; // Batalkan pengiriman form
          }
        }
        return true; // Lanjutkan pengiriman form jika validasi berhasil
      }
    </script>



    <!-- Modal Edit Laporan-->
    <?php $no = 0;
    foreach ($unit3 as $unt): ?>
      <div class="modal fade" id="EditDatalap<?php echo $unt['id_dokumen']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Laporan SA</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">

              <?php echo form_open_multipart('dokumen/update_data2'); ?>


              <input type="hidden" name="id_dokumen" value="<?php echo $unt['id_dokumen']; ?>">


              <div class="row">
                <div class="form-group col-md-12">
                  <label>Upload Laporan SA</label>
                  <input type="file" name="dok_lap" class="form-control" value="<?php echo $unt['dok_lap']; ?>">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label>*Keterangan</label>
                  <br>Max file size: 15MB
                  <br>Format file: PDF
                  <br>
                  <br>
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





</body>

</html>