<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Portfolio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_portfolio', 'port');
        $this->load->model('admin/Profil_m', 'profil');

        $autoload['helper'] = array('text');
        $this->load->library('session');
    }
    public function index()
    {


        $data = [


            'judul' => 'Portfolio | ' . $this->profil->get_profile('nama'),



            'perusahaan' => $this->profil->get_profile('nama'),
            'url' => $this->profil->get_profile('web_url'),
            'tentang' => $this->profil->get_profile('tentang'),
            'perusahaan' => $this->profil->get_profile('nama'),
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
            'Produk' => $this->port->get_produk()->result(),
            'berita' => $this->port->get_berita()->result(),

            'portfolio' => $this->port->get_portfolio()->result(),
            'kategori' => $this->port->get_kategori()->result(),

            'portfolio_konten' => $this->port->get_portfolio_konten()->result(),
            'portfolio' => $this->port->get_portfolio()->result(),

        ];



        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('pages/port_v', $data);

        $this->load->view('layout/footer', $data);
    }



    public function detail($slug, $id)
    {
        $ip    = $this->input->ip_address(); // Mendapatkan IP user
        $date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
        $waktu = time(); //
        $timeinsert = date("Y-m-d H:i:s");
        // Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
        $s = $this->db->query("SELECT * FROM section_visit WHERE ip='" . $ip . "' AND produk_id='" . $id . "'")->num_rows();
        $ss = isset($s) ? ($s) : 0;
        // Kalau belum ada, simpan data user tersebut ke database
        if ($ss == 0) {
            $data = array(
                'produk_id' => $id,
                'ip' => $ip,
                'hits' => 1,
                'date' => $date,
                'online' => $waktu,
                'time' => $timeinsert,
            );
            $this->port->input_visit($data);
        }

        // Jika sudah ada, update
        else {
            $this->db->query("UPDATE section_visit SET hits=hits+1, online='" . $waktu . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
        }
        $lihat  = $this->db->query("SELECT * FROM section_visit WHERE produk_id='" . $id . "'")->num_rows(); // Hitung jumlah pengunjung


        $desk = $this->db->get_where('post', ['slug' => $slug])->row_array();
        $val = $desk['deskripsi'];
        $tile = $desk['judul'];
        $data = [
            'judul' => $tile,

            'perusahaan' => $this->profil->get_profile('nama'),
            'url' => $this->profil->get_profile('web_url'),
            'tentang' => $this->profil->get_profile('tentang'),
            'perusahaan' => $this->profil->get_profile('nama'),
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
            'deskripsi' => $val,
            'Produk' => $this->port->get_produk()->result(),

            'produkWidget' => $this->port->get_produkWidget()->result(),
            'produkbyslug' => $this->port->get_portfolioByslug($slug)->result(),
            'portfolio' => $this->port->get_portfolio()->result(),
            'berita' => $this->port->get_berita()->result(),


        ];



        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('pages/port_detail_v.php', $data);
        $this->load->view('layout/footer', $data);
    }
}
