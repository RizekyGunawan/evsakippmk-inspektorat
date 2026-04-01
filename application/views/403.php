<!-- Custom Styles for 403 Page -->
<style>
/* Premium 403 Error Page CSS */
.error-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: calc(100vh - 120px);
    font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    padding: 20px;
}

.card-403 {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 3rem 4rem;
    text-align: center;
    max-width: 550px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.06), inset 0 0 0 1px rgba(255,255,255,0.6);
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
}

.card-403::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 6px;
    background: linear-gradient(90deg, #FF6B6B, #C0392B);
}

.card-403:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 45px rgba(0,0,0,0.08), inset 0 0 0 1px rgba(255,255,255,0.8);
}

.icon-wrapper-403 {
    width: 110px;
    height: 110px;
    margin: 0 auto 1.8rem;
    background: linear-gradient(135deg, #ff7675 0%, #d63031 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 15px 25px rgba(214, 48, 49, 0.3);
    position: relative;
    z-index: 1;
}

.icon-wrapper-403::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 3px solid rgba(255, 118, 117, 0.4);
    animation: pulse 2.5s infinite ease-out;
    z-index: -1;
}

@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    100% { transform: scale(1.5); opacity: 0; }
}

.icon-wrapper-403 i {
    font-size: 45px;
    color: white;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
}

.title-403 {
    font-size: 85px;
    font-weight: 800;
    margin-bottom: -5px;
    background: linear-gradient(135deg, #2d3436 0%, #636e72 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1;
    letter-spacing: -2px;
}

.subtitle-403 {
    font-size: 26px;
    font-weight: 700;
    color: #d63031;
    margin-bottom: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.desc-403 {
    font-size: 16px;
    color: #636e72;
    margin-bottom: 35px;
    line-height: 1.6;
    font-weight: 500;
}

.btn-dashboard-return {
    background: linear-gradient(135deg, #0984e3 0%, #0056b3 100%);
    border: none;
    color: white;
    padding: 14px 35px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 50px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 8px 15px rgba(9, 132, 227, 0.3);
}

.btn-dashboard-return:hover {
    background: linear-gradient(135deg, #0056b3 0%, #003d82 100%);
    transform: translateY(-3px);
    box-shadow: 0 12px 20px rgba(9, 132, 227, 0.4);
    color: white;
    text-decoration: none;
}

.btn-dashboard-return i {
    margin-right: 10px;
}
</style>

<!-- Main content -->
<div class="content-wrapper">
    <section class="content">
        <div class="error-container">
            <div class="card-403">
                <div class="icon-wrapper-403">
                    <i class="fas fa-user-lock"></i>
                </div>
                
                <h1 class="title-403">403</h1>
                <h3 class="subtitle-403">Akses Ditolak</h3>
                
                <p class="desc-403">
                    Maaf, sesi Anda tidak diekspektasikan atau peran akun Anda tidak memiliki hak otorisasi yang memadai untuk menjangkau halaman ini.
                </p>
                
                <a href="<?php echo base_url('dashboard/index'); ?>" class="btn-dashboard-return">
                    <i class="fas fa-home"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </section>
</div>
