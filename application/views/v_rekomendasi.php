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
            <h1>Rekomendasi</h1>
          </div>
          <div class="col-sm-7 col-5">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rekomendasi</li>
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
               <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 7) && !empty($loadtu)): ?>
                <?php foreach ($sev as $sv): ?>
                  <?php if ($sv['status_data1'] == 1): ?>
                <?php foreach ($loadtu as $load): ?>
                  <?php if ($load['status_data2'] == 0): ?>
                <button type="button" class="btn btn-primary"
                      data-toggle="modal" data-target="#TambahData">
            Tambah Data
        </button>
         <?php endif; ?>
         <?php endforeach; ?>
         <?php endif; ?>
         <?php endforeach; ?>
                <?php endif; ?>

                <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 7) && !empty($loadtu)): ?>
                <?php foreach ($sev as $sv): ?>
                  <?php if ($sv['status_data1'] == 1): ?>
                <?php foreach ($loadtu as $load): ?>
                  <?php if ($load['status_data2'] == 0 && $load['id_rekomendasi'] != ""): ?>
        <button type="button" class="btn btn-info"
                      data-toggle="modal" data-target="#EditStatus">
            Status
        </button>
            <?php endif; ?>
          <?php endforeach; ?>
         <?php endif; ?>
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
                      <th class="text-center align-middle" >Rekomendasi</th>
                      <th class="text-center align-middle" >Status</th>
                      <th class="text-center align-middle" colspan="2">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
                  	 $no = 1;
                  	 foreach ($rekom as $rkm) : ?>
                    <tr>
                     	<td class="text-center"><?php echo $no++ ?> </td>
                      <td class="text-justify"><?php echo htmlspecialchars($rkm['uraian_rekomendasi'], ENT_QUOTES, 'UTF-8'); ?></td>

						            

                  <td class="text-center  align-middle" style="width: 75px"><?php 
						       if ($rkm['status_data2'] == "0"){echo "Draft";} elseif ($rkm['status_data2'] == "1"){echo "Final";} else {echo "";}; ?></td>

                        <td class="text-center align-middle" style="width: 30px">
                           <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 7) && ($rkm['status_data2'] == "0")): ?>
                          <div class= "btn btn-success btn-xs" data-toggle="modal" data-target="#EditData<?php echo $rkm['id_rekomendasi']; ?>"><i class="fas fa-edit"></i></div>
                       <?php endif; ?>
                     </td>
                     <td class="text-center align-middle" style="width: 30px">
                      <?php if (($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 7) && ($rkm['status_data2'] == "0")): ?>
                     <div onclick="javascript: return confirm('Anda Yakin Hapus?')"><?php echo anchor('rekomendasI/hapus/'.$rkm['id_rekomendasi'], '<div class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></div>') ?>
                     </div>
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
<div class="modal fade" id="TambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Rekomendasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        
        <?php echo form_open_multipart('rekomendasi/tambah_data'); ?>
        	 

            <input hidden type="text" name="id_unit" class="form-control" value="<?php echo $this->session->userdata('id_unit'); ?>">
            <input hidden type="text" name="tahun" class="form-control" value="<?php echo $this->session->userdata('tahun'); ?>">
            

        <div class="row">
          <div class="form-group col-md-12">
            <label>Uraian Rekomendasi</label>
            <textarea required type="text" rows="10" name="uraian_rekomendasi" class="form-control text-justify"></textarea>
           </div>
           </div>
        	

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        	
        <?php echo form_close(); ?>
      </div>

      
    </div>
  </div>
</div>





<!-- Modal Edit Status -->
<div class="modal fade" id="EditStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Status Rekomendasi?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

      	<?php echo form_open_multipart('rekomendasi/update_data2'); ?>
       
        	 
        <input hidden type="text" name="id_unit" class="form-control" value="<?php echo $this->session->userdata('id_unit'); ?>">
            <input hidden type="text" name="tahun" class="form-control" value="<?php echo $this->session->userdata('tahun'); ?>">
        	
        	
          <!-- <div  class="row">
        	<div class="form-group col-md-12">
     		 <label>Status Rekomendasi</label>
      			<select name="status_data2" class="form-control">
        		<option hidden="true" value="">Pilih...</option>
        		<option value="0">Draft</option>
        		<option value="1">Final</option>
      			</select>
            </div>
   				 </div> -->
           
        	

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-primary">Ya</button>
        	
      <?php echo form_close(); ?>
      </div>

      
    </div>
  </div>
</div>


<!-- Modal Edit-->
<?php $no = 0; 
foreach ($rekom as $rkm) : ?>
<div class="modal fade" id="EditData<?php echo $rkm['id_rekomendasi']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Rekomendasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <?php echo form_open_multipart('rekomendasi/update_data'); ?>
       
           
          <input type="hidden" name="id_rekomendasi" value="<?php echo $rkm['id_rekomendasi']; ?>">

          
            <div class="row">
          <div class="form-group col-md-12">
            <label>Uraian Rekomendasi</label>
            <textarea required type="text" rows="10" name="uraian_rekomendasi" class="form-control text-justify"><?php echo $rkm['uraian_rekomendasi']; ?></textarea>
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




