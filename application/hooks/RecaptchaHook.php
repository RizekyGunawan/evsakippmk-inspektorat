<?php
class RecaptchaHook
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function verify()
    {
        // Ambil respons reCAPTCHA dari POST data
        $recaptchaResponse = $this->CI->input->post('g-recaptcha-response');

        // Site key reCAPTCHA
        $siteKey = '6LdG0D4mAAAAABC2kfkvSIT9ituxZkLgaR_ew79g';

        // Secret key reCAPTCHA
        $secretKey = '6LdG0D4mAAAAAIoQjHmgQjO-iz32nM5IWkcN28dj';

        // URL Endpoint untuk verifikasi reCAPTCHA
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        // Data yang akan dikirimkan ke Endpoint verifikasi reCAPTCHA
        $data = array(
            'secret'   => $secretKey,
            'response' => $recaptchaResponse,
            'remoteip' => $this->CI->input->ip_address()
        );

        // Konfigurasi cURL
        $options = array(
            CURLOPT_URL            => $url,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS    => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true
        );

        // Inisialisasi cURL
        $ch = curl_init();
        curl_setopt_array($ch, $options);

        // Eksekusi request ke Endpoint verifikasi reCAPTCHA
        $response = curl_exec($ch);

        // Tutup koneksi cURL
        curl_close($ch);

        // Parse response sebagai JSON
        $responseData = json_decode($response, true);

        // Cek status verifikasi reCAPTCHA
        if ($responseData['success'] !== true) {
            // Jika verifikasi gagal, redirect ke halaman login dan tampilkan pesan error
            $this->CI->session->set_flashdata('error', 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.');
            redirect('auth2/login');
        }
    }
}
