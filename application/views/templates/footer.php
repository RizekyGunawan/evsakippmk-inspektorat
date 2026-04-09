
<footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="https://www.bpkp.go.id/inspektorat.bpkp" target="_blank">Inspektorat BPKP</a><a href="https://www.kemenkopmk.go.id" target="_blank"> - Kemenko PMK</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.1
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
     <?php echo form_open_multipart('pilih/pilih'); ?>
                <ul class="nav nav-pills ml-1 p-3">
                  <li class="nav-item col-12">
            <label>Unit Kerja</label>

                

               <?php
                $id_role     = $this->session->userdata('id_role');
                $id_unit_es1 = $this->session->userdata('id_unit_es1');
                $allowed_roles = [2, 3, 4, 6, 7];
                $allowed_units = [1, 2, 3, 4, 5, 6, 7];

                // ——— Tim Evaluator (role 13): tampilkan unit yang ditugaskan ———
                if ((int) $id_role === 13):
                    $id_user_ev  = (int) $this->session->userdata('id_user');
                    $tahun_ev    = (int) $this->session->userdata('tahun');
                    $this->load->model('m_ev');
                    $ev_assigned = $this->m_ev->get_assigned_units($id_user_ev, $tahun_ev);
                ?>
                <?php if (count($ev_assigned) > 1): ?>
                <select name="id_unit" id="ev_unit_switcher" class="form-control">
                  <?php foreach ($ev_assigned as $ea): ?>
                    <option value="<?php echo $ea['id_unit']; ?>"
                      <?php echo ($ea['id_unit'] == $this->session->userdata('id_unit')) ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($ea['nm_unit'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <script>
                document.getElementById('ev_unit_switcher').addEventListener('change', function () {
                    var f = document.createElement('form');
                    f.method = 'post';
                    f.action = '<?php echo base_url('ev/set_unit_session'); ?>';
                    var inp = document.createElement('input');
                    inp.type = 'hidden'; inp.name = 'id_unit'; inp.value = this.value;
                    f.appendChild(inp);
                    document.body.appendChild(f);
                    f.submit();
                });
                </script>
                <?php else: ?>
                <select class="form-control" disabled>
                  <?php foreach ($ev_assigned as $ea): ?>
                    <option selected>
                      <?php echo htmlspecialchars($ea['nm_unit'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <?php endif; ?>

                <?php
                // ——— Role lain dengan akses pilih unit: dropdown lengkap ———
                elseif (in_array($id_role, $allowed_roles) || (($id_role == 1 || $id_role == 5) && in_array($id_unit_es1, $allowed_units))): ?>
                <!-- Kolom input pencarian -->
                <input type="text" id="searchInput" class="form-control mb-2" placeholder="Cari unit kerja...">
                <select id="id_unit" name="id_unit" class="form-control" value="">
                    <?php foreach ($unit4 as $unt4) : ?>
                    <option hidden="true" value="<?php echo $this->session->userdata('id_unit'); ?>"><?php echo $unt4['search_unit']; ?></option>
                    <?php endforeach; ?>
                    <?php foreach ($unit2 as $unt2) : ?>
                    <option hidden="true" value="<?php echo $this->session->userdata('id_unit'); ?>"><?php echo $unt4['search_unit']; ?></option>
                    <option value="<?php echo $unt2['id_unit']; ?>"><?php echo $unt2['search_unit']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php else: ?>
                <select name="id_unit" class="form-control" value="">
                    <?php foreach ($unit4 as $unt4) : ?>
                    <option hidden="true" value="<?php echo $this->session->userdata('id_unit'); ?>"><?php echo $unt4['search_unit']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php endif; ?>




              

            
            

            <label>Tahun</label>
            <select name="tahun" class="form-control" value="">
                <option hidden="true" value="<?php echo $this->session->userdata('tahun'); ?>"><?php echo $this->session->userdata('tahun'); ?></option>
            <option class="text-truncate" value="2022">2022</option>
            <option class="text-truncate" value="2023">2023</option>
            <option class="text-truncate" value="2024">2024</option>
            <option class="text-truncate" value="2025">2025</option>
            <option class="text-truncate" value="2026">2026</option>
            <option class="text-truncate" value="2027">2027</option>
            <option class="text-truncate" value="2028">2028</option>
            <option class="text-truncate" value="2029">2029</option>
            <option class="text-truncate" value="2030">2030</option>
            
            </select>

          </li>
         <ul class="nav nav-pills ml-1 p-4">
               <li class="nav-item">
          <button type="submit" class="btn btn-primary">Pilih</button>
          </li>
          </ul>
          </ul>
          
           <?php echo form_close(); ?>
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url() ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url() ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url() ?>assets/dist/js/pages/dashboard.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<script>
// Toastr — konfigurasi global
toastr.options = {
  "closeButton": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "timeOut": "3500",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};
</script>




<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>


 <script>
        // Fungsi untuk melakukan pencarian dan filter opsi select
        function filterSelect(inputId, selectId) {
            var input, filter, select, options, option, i, txtValue;
            input = document.getElementById(inputId);
            filter = input.value.toUpperCase();
            select = document.getElementById(selectId);
            options = select.getElementsByTagName('option');
            for (i = 0; i < options.length; i++) {
                option = options[i];
                txtValue = option.textContent || option.innerText;
                // Ubah menjadi nama unit
                txtValue = txtValue.toUpperCase().indexOf(filter) > -1;
                if (txtValue) {
                    option.style.display = "";
                } else {
                    option.style.display = "none";
                }
            }
        }

        // Panggil fungsi filterSelect saat input berubah
        var searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                filterSelect('searchInput', 'id_unit');
            });
        }
    </script>



<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>


   <script>
      
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>


    

    

</body>
</html>
