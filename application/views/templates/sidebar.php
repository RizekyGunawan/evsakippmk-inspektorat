 

 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url() ?>assets/dist/img/s.png" target="_blank" class="brand-link">
      <img src="<?php echo base_url() ?>assets/dist/img/s.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Ev-SAKIP</span>
    </a>

     <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url() ?>assets/dist/img/logo_pmk.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="https://www.kemenkopmk.go.id/" target="_blank" class="d-block">Kemenko PMK</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <div id="myDIV">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <?php if ($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 7): ?>

          <li class="nav-item">
            <a href="<?php echo base_url() ?>home/index" class="nav-link" data-id="home-link">
              <i class="nav-icon fas fa-info"></i>
              <p>
                Informasi
                
              </p>
            </a>
            
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url() ?>dashboard/index" class="nav-link" data-id="dashboard-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
            
          </li>
         
          <li class="nav-item">
            <a href="<?php echo base_url() ?>dokumen/index" class="nav-link" data-id="dokumen-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Status Pengisian
              
                
              </p>
            </a>
           
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>pm/index" class="nav-link" data-id="pm-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Pengisian Penilaian
                
              </p>
            </a>
            
          </li>
           <li class="nav-item">
            <a href="<?php echo base_url() ?>ev/index" class="nav-link" data-id="ev-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Evaluasi Inspektorat
                
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>dok_ev/index" class="nav-link" data-id="dok_ev-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Dokumen Evaluasi
                
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>rekomendasi/index" class="nav-link" data-id="rekomendasi-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Rekomendasi
               
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>tl/index" class="nav-link" data-id="tl-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Tindak Lanjut
               
              </p>
            </a>
            
          </li>

        <?php endif; ?>

         <!--  <?php if ($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 6 || $this->session->userdata('id_role') == 7): ?>
          <li class="nav-item">
            <a href="<?php echo base_url() ?>users/index" class="nav-link" data-id="tl-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Role Users
               
              </p>
            </a>
            
          </li>   
        <?php endif; ?> -->
          
          


     
      </nav>
      </div>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


<script>
  // Mendapatkan semua elemen nav-link
  const navLinks = document.querySelectorAll(".nav-link");

  // Menambahkan event listener ke setiap nav-link
  navLinks.forEach(navLink => {
    navLink.addEventListener("click", function(event) {
      // Mencegah navigasi default
      event.preventDefault();

      // Menghapus status active dari semua nav-link
      navLinks.forEach(link => link.classList.remove("active"));

      // Menambahkan status active hanya pada nav-link yang diklik
      this.classList.add("active");

      // Mendapatkan href yang ada pada elemen HTML yang diklik
      const href = this.getAttribute("href");

      // Lakukan navigasi ke halaman yang sesuai (menggunakan href)
      window.location.href = href; // Ini akan membawa Anda ke halaman yang sesuai
    });
  });

  // Mendapatkan URL saat ini
  const currentUrl = window.location.href;

  // Memeriksa setiap nav-link dan menambahkan kelas active jika URL cocok
  navLinks.forEach(navLink => {
    const linkUrl = navLink.getAttribute("href");
    if (currentUrl.includes(linkUrl)) {
      navLink.classList.add("active");
    }
  });

  
</script>





     
