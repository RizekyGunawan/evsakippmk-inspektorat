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
            <h1>Manajemen Role Users</h1>
          </div>
          <div class="col-sm-7 col-5">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manajemen Role Users</li>
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

                   
            </li>
                </ul>
             
              </div>
              
            


              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="table" style="width: 100%;" class="table table-bordered">
                  <thead class="thead-dark">
                    <tr>
                      <th class="text-center align-middle" style="width: 10px">No</th>
                      <th class="text-center align-middle" style="width: 200px">Nama</th>
                      <th class="text-center align-middle" style="width: 140px">NIP</th>
                      <th class="text-center align-middle" style="width: 20px">Gol</th>
                      <th class="text-center align-middle" style="width: 100px">Pangkat</th>
                      <th class="text-center align-middle">Jabatan</th>
                      <th class="text-center align-middle">Unit Kerja</th>
                      <th class="text-center align-middle" style="width: 50px">Es.1</th>
                      <th class="text-center align-middle" style="width: 50px">Role</th>
                      <th class="text-center align-middle" style="width: 10px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                 

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

<script type="text/javascript">
 
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('users/get_data')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0,4,6,7,9 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
        
    });
    
 
});



</script>
	





<!-- Modal Edit -->

<div class="modal fade" id="EditData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Peran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

      	<form id="formrole">
       
        	 
        	<input type="hidden" name="id_user" id="id_user">

        	
        	
          <div class="row">
        	<div class="form-group col-md-12">
     		    <label>Pilih Peran</label>
      			<select name="id_role" id="id_role" class="form-control">
            <?php if ($this->session->userdata('id_role') == 4): ?>
            <option value="1">Unit Kerja</option>
            <option value="2">Pembina</option>
            <option value="3">Evaluator</option>
            <option value="4">Admin</option>
            <option value="5">Admin Unit Kerja</option>
            <option value="6">Admin Pembina</option>
            <option value="7">Admin Evaluator</option>
            <option value="8">No Role</option>        
            <?php endif; ?>
            <?php if ($this->session->userdata('id_role') == 5): ?>
            <option value="1">Unit Kerja</option>
            <option value="5">Admin Unit Kerja</option>
            <option value="8">No Role</option>        
            <?php endif; ?>
        		<?php if ($this->session->userdata('id_role') == 6): ?>
            <option value="1">Unit Kerja</option>
            <option value="2">Pembina</option>
            <option value="5">Admin Unit Kerja</option>
            <option value="6">Admin Pembina</option>
            <option value="8">No Role</option>        
            <?php endif; ?>
            <?php if ($this->session->userdata('id_role') == 7): ?>
            <option value="3">Evaluator</option>
            <option value="7">Admin Evaluator</option>
            <option value="8">No Role</option>        
            <?php endif; ?>
      			</select>

            </div>
   				 </div>

           <?php if (($this->session->userdata('id_role') == 5 && ($this->session->userdata('id_unit_es1')==1 || $this->session->userdata('id_unit_es1')==2 || $this->session->userdata('id_unit_es1')==3 || $this->session->userdata('id_unit_es1')==4 || $this->session->userdata('id_unit_es1')==5 || $this->session->userdata('id_unit_es1')==6 || $this->session->userdata('id_unit_es1')==7)) || $this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 6): ?>
           <div class="row">
          <div class="form-group col-md-12">
            <label>Pilih Unit Kerja</label>
            <select name="id_unit" id="id_unit" class="form-control">
            <?php foreach ($unites1 as $ue1) : ?>
            <option value="<?php echo $ue1['id_unit']; ?>"><?php echo $ue1['nm_unit']; ?></option>
            <?php endforeach; ?>
            </select>

            </div>
           </div>
           <?php else: ?>
           <input type="hidden" name="id_unit" id="id_unit">
           <?php endif; ?>

           <?php if (($this->session->userdata('id_role') == 5 && ($this->session->userdata('id_unit_es1')==1 || $this->session->userdata('id_unit_es1')==2 || $this->session->userdata('id_unit_es1')==3 || $this->session->userdata('id_unit_es1')==4 || $this->session->userdata('id_unit_es1')==5 || $this->session->userdata('id_unit_es1')==6 || $this->session->userdata('id_unit_es1')==7)) || $this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 6): ?>
           <div class="row">
          <div class="form-group col-md-12">
            <label>Sebagai Pemangku Eselon 1?</label>
            <select name="id_unit_es1" id="id_unit_es1" class="form-control">
            
            <?php if ($this->session->userdata('id_role') != 4 && !in_array($this->session->userdata('id_unit_es1'), array(1,7))): ?>
            <option value="0">Tidak</option>
            <option value="<?php echo $this->session->userdata('id_unit_es1'); ?>">Ya</option>      
            <?php endif; ?>
            <?php if ($this->session->userdata('id_role') != 4 && in_array($this->session->userdata('id_unit_es1'), array(1,7))): ?>
            <option value="0">Tidak</option>
            <option value="1">BPKP</option>      
            <option value="7">Sekretariat Utama</option>      
            <?php endif; ?>
            <?php if ($this->session->userdata('id_role') == 4): ?>
            <option value="0">Tidak</option>
            <option value="1">BPKP</option>      
            <option value="2">Deputi 1 Perekonomian</option>      
            <option value="3">Deputi 2 Polhukam</option>      
            <option value="4">Deputi 3 PKD</option>      
            <option value="5">Deputi 4 AN</option>      
            <option value="6">Deputi 5 Investigasi</option>      
            <option value="7">Sekretariat Utama</option>      
            <?php endif; ?>
           
            </select>

            </div>
           </div>
           <?php else: ?>
           <input type="hidden" name="id_unit_es1" id="id_unit_es1">
           <?php endif; ?>
        	



        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submitrole">Save</button>
         </form>	
      
      </div>

      
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function () {
    $("#submitrole").click(function (event) {
      event.preventDefault();
        // Jika validasi kedua tidak memunculkan pesan kesalahan
        if ($('#formrole').valid()) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('users/update_data'); ?>",
                data: $("#formrole").serialize(),
                success: function (response) {
                    toastr.success('Data berhasil disimpan!', 'Sukses');
                    location.reload();
                },
                error: function () {
                    alert("Terjadi kesalahan saat menyimpan data.");
                }
            });
        }
    });
});
</script>

<script>
$(document).ready(function() {
  // Fungsi untuk mengambil dan menampilkan data pada modal
  function showData(id_user) {
    // Mengirim permintaan AJAX ke Datakriteria/getData dengan parameter id_user
    $.ajax({
      url: '<?php echo base_url("Datarole/getData"); ?>',
      type: 'GET',
      data: { id_user: id_user }, // Menggunakan parameter id_user
      dataType: 'json',
      success: function(response) {
        // Mengisikan data ke dalam elemen-elemen pada modal
        $('#id_user').val(response.id_user);
        $('#id_unit').val(response.id_unit);
        $('#id_unit_es1').val(response.id_unit_es1);
        $('#id_role').val(response.id_role);
        // Tampilkan modal
        $('#EditData').modal('show');
      },
      error: function() {
        alert('Terjadi kesalahan saat mengambil data.');
      }
    });
  }

  // Event click pada link dengan class "open-modal"
  $(document).on('click', '.open-modal', function(e) {
    e.preventDefault();
    // Mengambil id dari atribut data-id
    var id_user = $(this).data('id_user'); // Menggunakan data-id_user sebagai sumber id_user
    // Memanggil fungsi showData dengan parameter id_user
    showData(id_user);
  });
});
</script>



</body>
</html>




