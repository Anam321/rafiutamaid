<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jasa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_jasa', 'jasa');
        $this->load->model('admin/Profil_m', 'profil');

        $autoload['helper'] = array('text');
        $this->load->library('session');
    }
    public function index()
    {


        $data = [


            'judul' => 'Jasa Dan Layanan | ' . $this->profil->get_profile('nama'),



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
            'Produk' => $this->jasa->get_produk()->result(),


            'produk_konten' => $this->jasa->get_produk_konten()->result(),
            'portfolio' => $this->jasa->get_portfolio()->result(),
            'berita' => $this->jasa->get_berita()->result(),
        ];



        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('pages/jasa_v', $data);

        $this->load->view('layout/footer', $data);
    }

    public function listkatalog()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $produk = $this->katalog->get_dataproduk();
            $data = array();
            foreach ($produk as $row) {
                $id = $row['produk_id'];
                $visitorproduk = $this->db->query("SELECT * FROM section_visit WHERE produk_id=$id")->num_rows();
                $list = ' <div class="col-md-4 mb-4">
                <div class="card border-0 mb-2">
                    <img class="card-img-top" src="' . base_url() . 'assets/upload/gallery/' . $row['foto'] . '" alt="">
                    <div class="card-body bg-white p-4">
                        <div class="d-flex align-items-center mb-3">
                            <a class="btn btn-primary" href="' . base_url() . 'katalog/detailproduk/' . $row['slug'] . '/' . $row['produk_id'] . '"><i class="fa fa-link"></i></a>
                           <a href="' . base_url() . 'katalog/detailproduk/' . $row['slug'] . '/' . $row['produk_id'] . '"> <h5 class="m-0 ml-3 text-truncate">' . $row['nama_produk'] . '</h5></a>
                        </div>
                       
                        <div class="d-flex">
                            <small class="mr-3"><i class="fa fa-eye text-primary"></i> ' . $visitorproduk . '</small>
                            <small class="mr-3"><i class="fa fa-folder text-primary"></i> ' . $row['kategori'] . '</small>
                           
                        </div>
                    </div>
                </div>
            </div>';

                $data[] = $list;
            }

            echo json_encode($data);
        }
    }

    public function orderbykategori($kategori)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $produk = $this->katalog->orderbykategori($kategori);
            $data = array();
            foreach ($produk as $row) {

                $list = ' <div class="col-md-4 mb-4">
                                <div class="card border-0 mb-2">
                                    <img class="card-img-top" src="' . base_url() . 'assets/upload/gallery/' . $row['foto'] . '" alt="">
                                    <div class="card-body bg-white p-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <a class="btn btn-primary" href="' . base_url() . 'katalog/detailproduk/' . $row['slug'] . '/' . $row['produk_id'] . '"><i class="fa fa-link"></i></a>
                                        <a  href="' . base_url() . 'katalog/detailproduk/' . $row['slug'] . '/' . $row['produk_id'] . '"> <h5 class="m-0 ml-3 text-truncate">' . $row['nama_produk'] . '</h5></a>
                                        </div>
                                    
                                        <div class="d-flex">
                                            <small class="mr-3"><i class="fa fa-eye text-primary"></i> Admin</small>
                                            <small class="mr-3"><i class="fa fa-folder text-primary"></i> ' . $row['kategori'] . '</small>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>';

                $data[] = $list;
            }

            echo json_encode($data);
        }
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
            'Produk' => $this->jasa->get_produk()->result(),

            'produkWidget' => $this->jasa->get_produkWidget()->result(),
            'produkbyslug' => $this->jasa->get_produkbyslug($slug)->result(),
            'portfolio' => $this->jasa->get_portfolio()->result(),
            'berita' => $this->jasa->get_berita()->result(),


        ];



        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('pages/jasa_detail_v.php', $data);
        $this->load->view('layout/footer', $data);
    }
}
