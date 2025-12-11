<?php
/*
 * ========================================
 * FILE BACKUP - v_dok_ev_copy.php
 * ========================================
 * 
 * File ini adalah backup dari v_dok_ev.php SEBELUM penghapusan kolom
 * "Berita Acara Evaluasi 2024" dan "Laporan Evaluasi Final 2024"
 * 
 * Tanggal Backup: 2025-12-11
 * 
 * JANGAN GUNAKAN FILE INI untuk production!
 * File ini hanya untuk referensi jika diperlukan rollback.
 * 
 * Seluruh konten di-comment agar tidak mengganggu saat running aplikasi.
 * 
 * ========================================
 */

/*
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
                      <i class="fas fa-chart-line"></i> Perbandingan & Predikat
                    </a>
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
                      <th class="text-center align-middle" >Nama Unit</th>
                      <th class="text-center align-middle">Progres Kriteria</th>
                      <th class="text-center align-middle" >Nilai Eva</th>
<!--Header Kolom  -->                      
                      <?php if($this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "3" || $this->session->userdata('id_role') == "7"): ?>
                      <th class="text-center align-middle" colspan="2" style="width: 120px">Berita Acara Evaluasi <?php echo $this->session->userdata('tahun'); ?></th>
                      <th class="text-center align-middle" colspan="2" style="width: 120px">Laporan Evaluasi Final <?php echo $this->session->userdata('tahun'); ?></th>
                      <?php endif; ?>
                      <?php if($this->session->userdata('id_role') == "2" || $this->session->userdata('id_role') == "6"): ?>
                      <th class="text-center align-middle" style="width: 120px">Berita Acara Evaluasi <?php echo $this->session->userdata('tahun'); ?></th>
                      <th class="text-center align-middle" style="width: 120px">Laporan Evaluasi Final <?php echo $this->session->userdata('tahun'); ?></th>
<!--Batas akhir  -->
                      <?php endif; ?>
                      <th class="text-center align-middle" style="width: 120px">Status Evaluasi</th>
                      <?php if($this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "3" || $this->session->userdata('id_role') == "7"): ?>
                      <th class="text-center align-middle" >Aksi</th>
                      <?php endif; ?>
                    </tr>
                  </thead>

                  <?php if($this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "3" || $this->session->userdata('id_role') == "7"): ?>
                  <tbody>

                  <?php
                  	 $no = 1;
                  	 foreach ($unit3monev2 as $unt) : ?>
                    <tr>
                     	<td class="text-center"><?php echo $no++ ?> </td>
                    	<td title="<?php echo $unt['nm_unit']; ?>" class="text-center"><?php echo $unt['kd_unit']; ?></td>
                      <td style="width: 800px"><?php echo $unt['nm_unit']; ?></td>
                      <td class="text-center" style="width: 120px"><?php $format = number_format((float)$unt['persen'],2,",","."); echo $format; ?>%</td> 
                      <td class="text-center" style="width: 120px"><?php $format = number_format((float)$unt['totalnilai'],2,",","."); echo $format; ?></td>
<!-- Pengapusan Kolom -->
                      <td class="text-center align-middle" style="width: 30px">
                        <?php if ($unt['status_data1'] == "0"): ?>
                        <div class= "btn btn-primary btn-xs" data-toggle="modal" data-target="#EditDataba<?php echo $unt['id_dok_ev']; ?>">Upload</div>
                       <?php endif; ?>
                     </td>

                     <td class="text-center align-middle" style="width: 30px">
                      <?php if ($unt['ba_ev'] != ""): ?>
                      <a class= "btn btn-secondary btn-xs" href="../assets/dok_ev/<?php echo $unt['ba_ev']; ?>" target="_blank">Preview</a>
                       <?php endif; ?>
                     </td>

		            <td class="text-center align-middle" style="width: 30px">
                          <?php if ($unt['status_data1'] == "0"): ?>
                          <div class= "btn btn-primary btn-xs" data-toggle="modal" data-target="#EditDatalap<?php echo $unt['id_dok_ev']; ?>">Upload</div>
                       <?php endif; ?>
                     </td>

                     <td class="text-center align-middle" style="width: 30px">
                      <?php if ($unt['lap_ev'] != ""): ?>
                      <a class= "btn btn-secondary btn-xs" href="../assets/dok_ev/<?php echo $unt['lap_ev']; ?>" target="_blank">Preview</a>
                       <?php endif; ?>
                     </td>
<!-- Batas Pengapusan Kolom -->
                  <td class="text-center"><?php 
						       if ($unt['status_data1'] == "0"){echo "Draft";} elseif ($unt['status_data1'] == "1"){echo "Final";} else {echo "";}; ?></td>

<!-- Penghapusan Aksi -->
                        <td class="text-center align-middle" style="width: 30px">
                          <?php if (($unt['status_data1'] == "0") && ($unt['ba_ev'] != "") && ($unt['lap_ev'] != "")): ?>
                          <div class= "btn btn-success btn-xs" data-toggle="modal" data-target="#EditData<?php echo $unt['id_dok_ev']; ?>"><i class="fas fa-edit"></i></div>
                       <?php endif; ?>
                     </td>
<!-- Batas Penghapusan Aksi -->
                      
                    </tr>
                   <?php endforeach; ?>

                  </tbody>
                  <?php endif; ?>

                  <?php if($this->session->userdata('id_role') == "2" || $this->session->userdata('id_role') == "6"): ?>
                  <tbody>

                  <?php
                     $no = 1;
                     foreach ($unit3monev2 as $unt) : ?>
                    <tr>
                      <td class="text-center"><?php echo $no++ ?> </td>
                      <td class="text-center"><?php echo $unt['kd_unit']; ?></td>
                      <td style="width: 900px"><?php echo $unt['nm_unit']; ?></td>
                      <td class="text-center" style="width: 120px"><?php $format = number_format((float)$unt['persen'],2,",","."); echo $format; ?>%</td> 
                      <td class="text-center" style="width: 120px"><?php $format = number_format((float)$unt['totalnilai'],2,",","."); echo $format; ?></td>
                     
<!--  Penghapusan Kolom-->
                     <td class="text-center align-middle" style="width: 30px">
                      <?php if ($unt['ba_ev'] != ""): ?>
                      <a class= "btn btn-secondary btn-xs" href="../assets/dok_ev/<?php echo $unt['ba_ev']; ?>" target="_blank">Preview</a>
                       <?php endif; ?>
                     </td>
<!--  Penghapusan Kolom-->

                     <td class="text-center align-middle" style="width: 30px">
                      <?php if ($unt['lap_ev'] != ""): ?>
                      <a class= "btn btn-secondary btn-xs" href="../assets/dok_ev/<?php echo $unt['lap_ev']; ?>" target="_blank">Preview</a>
                       <?php endif; ?>
                     </td>
                 
                  <td class="text-center"><?php 
                   if ($unt['status_data1'] == "0"){echo "Draft";} elseif ($unt['status_data1'] == "1"){echo "Final";} else {echo "";}; ?></td>

                       
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


	




<!-- Modal Edit -->
<?php $no = 0; 
foreach ($unit3monev as $unt) : ?>
<div class="modal fade" id="EditData<?php echo $unt['id_dok_ev']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        	
        	
          <div  class="row">
        	<div class="form-group col-md-12">
     		 <label for="inputState">Status Evaluasi</label>
      			<select id="inputState" name="status_data1" class="form-control" value="<?php 
					  if ($unt['status_data1'] == "0"){echo "Draft";} elseif ($unt['status_data1'] == "1"){echo "Final";} else {echo "";}; ?>">
        		<option hidden="true" value="<?php echo $unt['status_data1']; ?>"><?php 
					  if ($unt['status_data1'] == "0"){echo "Draft";} elseif ($unt['status_data1'] == "1"){echo "Final";} else {echo "";}; ?></option>
        		<option <?php 
              if ($unt['status_data1'] == "0"){echo "";} elseif ($unt['status_data1'] == "1"){echo "Hidden";} else {echo "Hidden";}; ?> value="0">Draft</option>
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


<!-- Modal Edit Laporan-->
<?php $no = 0; 
foreach ($unit3monev as $unt) : ?>
<div class="modal fade" id="EditDatalap<?php echo $unt['id_dok_ev']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Laporan Evaluasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <?php echo form_open_multipart('dok_ev/update_data2'); ?>
       
           
          <input type="hidden" name="id_dok_ev" value="<?php echo $unt['id_dok_ev']; ?>">

          
            <div class="row">
            <div class="form-group col-md-12">
            <label>Upload Laporan Evaluasi</label>
            <input type="file" name="lap_ev" class="form-control" value="<?php echo $unt['lap_ev']; ?>">
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


<!-- Modal Edit BA-->
<?php $no = 0; 
foreach ($unit3monev as $unt) : ?>
<div class="modal fade" id="EditDataba<?php echo $unt['id_dok_ev']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">BA Evaluasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <?php echo form_open_multipart('dok_ev/update_data3'); ?>
       
           
          <input type="hidden" name="id_dok_ev" value="<?php echo $unt['id_dok_ev']; ?>">

          
            <div class="row">
            <div class="form-group col-md-12">
            <label>Upload BA Evaluasi</label>
            <input type="file" name="ba_ev" class="form-control" value="<?php echo $unt['ba_ev']; ?>">
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
<!-- Batas Modal Edit BA -->



</body>
</html>




*/
?>
