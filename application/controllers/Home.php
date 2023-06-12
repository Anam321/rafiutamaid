<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_home', 'home');
        $this->load->model('admin/Profil_m', 'profil');

        $autoload['helper'] = array('text');
        $this->load->library('session');
    }
    public function index()
    {
        $ip    = $this->input->ip_address(); // Mendapatkan IP user
        $date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
        $waktu = time(); //
        $timeinsert = date("Y-m-d H:i:s");

        // Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
        $s = $this->db->query("SELECT * FROM visitor WHERE ip='" . $ip . "' AND date='" . $date . "'")->num_rows();
        $ss = isset($s) ? ($s) : 0;


        // Kalau belum ada, simpan data user tersebut ke database
        if ($ss == 0) {
            $this->db->query("INSERT INTO visitor(ip, date, hits, online, time) VALUES('" . $ip . "','" . $date . "','1','" . $waktu . "','" . $timeinsert . "')");
        }

        // Jika sudah ada, update
        else {
            $this->db->query("UPDATE visitor SET hits=hits+1, online='" . $waktu . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
        }


        $data = [

            'judul' => $this->profil->get_profile('title'),
            'perusahaan' => $this->profil->get_profile('nama'),
            'url' => $this->profil->get_profile('web_url'),

            'slide' => $this->home->get_slide()->result(),
            'Produk' => $this->home->get_produk()->result(),
            'kategori' => $this->home->get_kategori()->result(),
            'portfolio' => $this->home->get_portfolio()->result(),
            'berita' => $this->home->get_berita()->result(),
            'perusahaan' => $this->profil->get_profile('nama'),

            'video' => $this->profil->get_profile('video'),

            'pengunjung' => $this->home->get_pengunjung()->result(),
            'slogan' => $this->profil->get_profile('slogan'),
            'company_name' => $this->profil->get_profile('company_name'),
            'logo' => $this->profil->get_profile('logo'),
            'alamat' => $this->profil->get_profile('alamat'),
            'whatsap' => $this->profil->get_kontak('whatsap'),
            'facebook' => $this->profil->get_kontak('facebook'),
            'instagram' => $this->profil->get_kontak('instagram'),
            'tiktok' => $this->profil->get_kontak('tiktok'),
            'email' => $this->profil->get_kontak('email'),
            'telpon' => $this->profil->get_kontak('telpon'),
            'foto' => $this->profil->get_profile('foto'),
            'deskripsi' => $this->profil->get_profile('deskripsi'),

        ];



        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('pages/home_v', $data);
        $this->load->view('layout/footer', $data);
    }


    public function inputtesti()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $slug = str_replace(' ', '-', $this->input->post('nama'));
            $config['upload_path'] = './assets/upload/poto/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['file_name'] = strtolower($slug) . '-' . time();
            $config['overwrite'] = true;
            $config['max_size'] = 3024; // 1MB

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $insert['status'] = '01';
                $insert['type'] = 'error';
                $insert['mess'] = $this->upload->display_errors();
                echo json_encode($insert);
            } else {
                $image_data = $this->upload->data();
                $data = array(
                    'nama' => $this->input->post('nama'),
                    'testi' => $this->input->post('testi'),
                    'email' => $this->input->post('email'),
                    'date_post' => date("Y-m-d H:i:s"),
                    'foto' => $image_data['file_name'],
                    'is_active' => 0,
                    'confirm' => 1,
                );

                $insert = $this->home->input_testi($data);
                echo json_encode($insert);
            }
        }
    }

    public function whatsappTracking()
    {
        $ip    = $this->input->ip_address(); // Mendapatkan IP user
        $date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
        $timeinsert = date("Y-m-d H:i:s");
        $data = array(
            'hits' => 1,
            'ip' => $ip,
            'date' => $date,
            'time' => $timeinsert,
        );
        $this->home->insertTracking($data);
    }
}
