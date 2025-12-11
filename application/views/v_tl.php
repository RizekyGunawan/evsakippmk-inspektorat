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
            <h1>Tindak Lanjut</h1>
          </div>
          <div class="col-sm-7 col-5">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tindak Lanjut</li>
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

                   <div <?php if($this->session->userdata('id_unit') == ""){echo "hidden";}else{echo "";}; ?> class="col-">
           
                   
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
                      <th class="text-center align-middle" >Rekomendasi</th>
                      <th class="text-center align-middle" >Tindak Lanjut</th>
                      <th class="text-center align-middle" >Target TL</th>
                      <th class="text-center align-middle" >Realisasi TL</th>
                      <th class="text-center align-middle" >Bukti TL</th>
                      <th class="text-center align-middle" >Status</th>
                      <th class="text-center align-middle" colspan="2">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
                  	 $no = 1;
                  	 foreach ($tla as $tl) : ?>
                    <tr>
                     	<td class="text-center"><?php echo $no++ ?> </td>
                      <td class="text-justify" ><?php echo htmlspecialchars($tl['uraian_rekomendasi'], ENT_QUOTES, 'UTF-8'); ?></td>

                      <td class="text-justify" style="width: 350px;"><?php echo htmlspecialchars($tl['uraian_tl'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td class="text-justify text-center align-middle" style="width: 110px;"><?php echo $tl['target_tl']; ?></td>
                      <td class="text-justif text-centery align-middle" style="width: 110px;"><?php echo $tl['realisasi_tl']; ?></td>
                      <td class="text-truncate align-middle" style="max-width: 150px; width: 150px;">
                                      <i class="expandable-table-caret"></i>
                                      <div class="text-truncate">
                                        <?php
                                        $url = $tl['bukti_tl'];
                                        
                                        // Pemeriksaan protokol, jika tidak ada, tambahkan "http://"
                                        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                                            $url = "http://" . $url;
                                        }
                                        ?>
                                        <a href="<?php echo $url; ?>" target="_blank"><?php echo htmlspecialchars($tl['bukti_tl'], ENT_QUOTES, 'UTF-8'); ?></a>
                                    </div>
                                    </td>
                                    

						            

                  <td class="text-center align-middle" style="width: 100px"><?php 
						       if ($tl['status_data3'] == "0"){echo "Belum TL";} elseif ($tl['status_data3'] == "1"){echo "Realisasi";} else {echo "";}; ?></td>

                        <td class="text-center align-middle" style="width: 30px">
                          <?php if (($this->session->userdata('id_role') == 4 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5) && ($this->session->userdata('id_unit') == $this->session->userdata('id_unit2') || 
                               $this->session->userdata('id_unit') == $this->session->userdata('id_unit_es1')))) && $tl['status_data3'] == "0"): ?>
                          <div class= "btn btn-success btn-xs" data-toggle="modal" data-target="#EditData<?php echo $tl['id_tl']; ?>"><i class="fas fa-edit"></i></div>
                       <?php endif; ?>
                     </td>
                     <td class="text-center align-middle" style="width: 30px">
                          <?php if (($this->session->userdata('id_role') == 4 || (($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 5) && ($this->session->userdata('id_unit') == $this->session->userdata('id_unit2') || 
                               $this->session->userdata('id_unit') == $this->session->userdata('id_unit_es1')))) && $tl['status_data3'] == "0"): ?>
                          <div class= "btn btn-primary btn-xs" data-toggle="modal" data-target="#EditStatus<?php echo $tl['id_tl']; ?>"><i class="fas fa-check"></i></div>
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


	


<!-- Modal Status -->
<?php $no = 0; 
foreach ($tla as $tl) : ?>
<div class="modal fade" id="EditStatus<?php echo $tl['id_tl']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Status Tindak Lanjut</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

      	<?php echo form_open_multipart('tl/update_data2'); ?>
       
        	 
        	<input type="hidden" name="id_tl" value="<?php echo $tl['id_tl']; ?>">

        	
        	
          <div  class="row">
        	<div class="form-group col-md-12">
     		 <label>Status Tindak Lanjut</label>
      			<select name="status_data3" class="form-control" value="<?php 
						  if ($tl['status_data3'] == "0"){echo "Belum TL";} elseif ($tl['status_data3'] == "1"){echo "Realisasi";} else {echo "";}; ?>">
        		<option hidden="true" value="<?php echo $tl['status_data3']; ?>"><?php 
						  if ($tl['status_data3'] == "0"){echo "Belum TL";} elseif ($tl['status_data3'] == "1"){echo "Realisasi";} else {echo "";}; ?></option>
        		<option value="0">Belum TL</option>
        		<option value="1">Realisasi</option>
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


<!-- Modal Edit -->
<?php $no = 0; 
foreach ($tla as $tl) : ?>
<div class="modal fade" id="EditData<?php echo $tl['id_tl']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Tindak Lanjut</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <?php echo form_open_multipart('tl/update_data'); ?>
       
           
          <input type="hidden" name="id_tl" value="<?php echo $tl['id_tl']; ?>">

          
            <div class="row">
          <div class="form-group col-md-6">
            <label>Uraian Rekomendasi</label>
            <textarea type="text" rows="10" name="uraian_rekomendasi" readonly class="form-control text-justify"><?php echo $tl['uraian_rekomendasi']; ?></textarea>
           </div>
           <div class="form-group col-md-6">
            <label>Uraian TL</label>
            <textarea required type="text" rows="10" name="uraian_tl" class="form-control text-justify"><?php echo $tl['uraian_tl']; ?></textarea>
           </div>
           </div>

           <div class="row">
            <div class="form-group col-md-3">
            <label>Target TL</label>
            <input type="date" name="target_tl" value="<?php echo $tl['target_tl']; ?>" class="form-control">
          </div>
          <div class="form-group col-md-3">
            <label>Realisasi TL</label>
            <input type="date" name="realisasi_tl" value="<?php echo $tl['realisasi_tl']; ?>" class="form-control">
          </div>
           <div class="form-group col-md-6">
            <label>Bukti TL (Link)</label>
            <input type="text" name="bukti_tl" value="<?php echo $tl['bukti_tl']; ?>" class="form-control">
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




