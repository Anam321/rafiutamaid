<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/post_m', 'katalog');
        $this->load->model('admin/profil_m', 'profil');
        is_logged_in();

        $this->load->library('session');
    }
    public function index()
    {
        $data = [
            //title Page
            'judul' => 'Katalog | ' . $this->profil->get_profile('nama'),
            'logo' =>  $this->profil->get_profile('logo'),
            'perusahaan' => $this->profil->get_profile('nama'),
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'kategori' => $this->katalog->get_kategori()->result(),

        ];



        $this->load->view('themplates/header', $data);
        $this->load->view('themplates/sidebar', $data);
        $this->load->view('themplates/navbar', $data);
        $this->load->view('admin/post_v', $data);
        $this->load->view('js/post_js', $data);

        $this->load->view('themplates/footer', $data);
    }
    function waktu_lalu($timestamp)
    {
        $selisih = time() - strtotime($timestamp);
        $detik = $selisih;
        $menit = round($selisih / 60);
        $jam = round($selisih / 3600);
        $hari = round($selisih / 86400);
        $minggu = round($selisih / 604800);
        $bulan = round($selisih / 2419200);
        $tahun = round($selisih / 29030400);
        if ($detik <= 60) {
            $waktu = $detik . ' detik yang lalu';
        } else if ($menit <= 60) {
            $waktu = $menit . ' menit yang lalu';
        } else if ($jam <= 24) {
            $waktu = $jam . ' jam yang lalu';
        } else if ($hari <= 7) {
            $waktu = $hari . ' hari yang lalu';
        } else if ($minggu <= 4) {
            $waktu = $minggu . ' minggu yang lalu';
        } else if ($bulan <= 12) {
            $waktu = $bulan . ' bulan yang lalu';
        } else {
            $waktu = $tahun . ' tahun yang lalu';
        }
        return $waktu;
    }

    public function datatable()
    {
        $produkrow = $this->katalog->get_konten();
        $no = 1;
        foreach ($produkrow as $row) {
            $id = $row['id'];

            $visitorproduk = $this->db->query("SELECT * FROM section_visit WHERE produk_id=$id")->num_rows();
            $tbody = array();
            $tbody[] = $no++;
            $gambar = '  <img src="' . base_url() . 'assets/upload/artikel/' . $row['foto'] . '" alt="contact-img" title="contact-img" class="rounded me-3" height="48">
                                            <p class="m-0 d-inline-block align-middle font-16">
                                                <a href="apps-ecommerce-products-details.html" class="text-body">' . $row['judul'] . '</a>
                                                <br>
                                                ' . $visitorproduk . ' Dilihat
                                            </p>';
            $tbody[] = $gambar;

            $tbody[] = $row['kategori'];
            $tbody[] = $this->waktu_lalu($row['date_post']);


            if ($row['slide'] == 1) {
                $switch = '<button type="button" class="btn btn-success btn-sm">ON</button><button onclick="of_slide(' . $row['id'] . ')" type="button" class="btn btn-dark  btn-sm">OF</button>';
            } else {
                $switch = '<button type="button" onclick="on_slide(' . $row['id'] . ')" class="btn btn-dark btn-sm">ON</button><button type="button" class="btn btn-danger btn-sm">OF</button>';
            }


            $tbody[] =  $switch;
            if ($row['action_produk'] == 1) {
                $switch = '<button type="button" class="btn btn-success btn-sm">ON</button><button onclick="produk_of(' . $row['id'] . ')" type="button" class="btn btn-dark  btn-sm">OF</button>';
            } else {
                $switch = '<button type="button" onclick="produk_on(' . $row['id'] . ')" class="btn btn-dark btn-sm">ON</button><button type="button" class="btn btn-danger btn-sm">OF</button>';
            }


            $tbody[] =  $switch;
            if ($row['action_port'] == 1) {
                $switch = '<button type="button" class="btn btn-success btn-sm">ON</button><button onclick="port_of(' . $row['id'] . ')" type="button" class="btn btn-dark  btn-sm">OF</button>';
            } else {
                $switch = '<button type="button" onclick="port_on(' . $row['id'] . ')" class="btn btn-dark btn-sm">ON</button><button type="button" class="btn btn-danger btn-sm">OF</button>';
            }


            $tbody[] =  $switch;
            if ($row['action_berita'] == 1) {
                $switch = '<button type="button" class="btn btn-success btn-sm">ON</button><button onclick="berita_of(' . $row['id'] . ')" type="button" class="btn btn-dark  btn-sm">OF</button>';
            } else {
                $switch = '<button type="button" onclick="berita_on(' . $row['id'] . ')" class="btn btn-dark btn-sm">ON</button><button type="button" class="btn btn-danger btn-sm">OF</button>';
            }


            $tbody[] =  $switch;
            $action = '
                   <div class="table-action">
                   
                        <a href="javascript:void(0);" onclick="detail(' . $row['id'] . ')" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                     
                       
                        <a href="javascript:void(0);" class="action-icon " data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-square-edit-outline"></i></a>
                         <div class="dropdown-menu bg-dark ">
                            <a class="dropdown-item " href="javascript:void(0);" onclick="edit(' . $row['id'] . ')">Edit Produk</a>
                            <a class="dropdown-item " href="javascript:void(0);" onclick="addfoto(' . $row['id'] . ')">Tambah Foto</a>
                        </div> 
                        </div>
                     
                        <a href="javascript:void(0);" onclick="hapus(' . $row['id'] . ')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                    </div>
';
            $tbody[] = $action;

            $data[] = $tbody;
        }
        if ($produkrow) {
            echo json_encode(array('data' => $data));
        } else {
            echo json_encode(array('data' => 0));
        }
    }


    public function detailpost($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $detailpro = $this->katalog->get_kontenDetail($id);
            // $fotoproduk = $this->katalog->get_fotoproduk($id);
            $data = array();

            foreach ($detailpro as $row) {

                $list = '<div class="row">
                            <div class="col-12">


                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <!-- Product image -->
                                                <a href="javascript: void(0);" class="text-center d-block mb-4">
                                                  <img src="' . base_url() . 'assets/upload/artikel/' . $row['foto'] . '" class="img-fluid" style="max-width: 450px;" alt="Product-img">
                                                </a>
                                                <div class="row">
                                      </div>
                            
                                            </div> 
                                            <div class="col-lg-6">
                                                <form class="ps-lg-4">
                                                  
                                                    <h3 class="mt-0">' . $row['judul'] . ' <a href="javascript: void(0);" class="text-muted"><i class="mdi mdi-square-edit-outline ms-2"></i></a> </h3>
                                                    <p class="mb-1">Added Date: ' . $this->waktu_lalu($row['date_post']) . '</p>
                                                
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Description:</h6>
                                                      ' . $row['deskripsi'] . '
                                                    </div>

                                                </form>
                                            </div>
                                        </div> 

                                    </div> 
                                </div> 


                            </div> 
                            <div class="col-lg-12">
                            
                                <div class="card">
                                    <div class="card-body">
                                       ' . $row['konten'] . '
                                    </div> 
                                </div> 
                            </div>
                        </div>';

                $data[] = $list;
            }

            echo json_encode($data);
        }
    }


    public function subFoto($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subfoto = $this->katalog->get_datafoto($id);
            $data = array();
            foreach ($subfoto as $row) {

                $list = ' <div class="col-lg-6 mb-2">
                                        
                                        <div class="card card-body">
                                    <img src="' . base_url() . 'assets/upload/artikel/' . $row['foto'] . '" alt="image" class="img-fluid rounded" />
                                    <a href="javascript: void(0);" onclick="remove(' . $row['gallery_id'] . ')"  class="btn btn-primary">Remove</a>
                                </div>
                                    </div>';

                $data[] = $list;
            }

            echo json_encode($data);
        }
    }
    public function input_konten()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $slug = str_replace(' ', '-', $this->input->post('judul'));
            $config['upload_path'] = './assets/upload/artikel/';
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
                    'judul' => $this->input->post('judul'),
                    'slug'          => strtolower($slug),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'konten' => $this->input->post('konten'),
                    'kategori' => $this->input->post('kategori'),
                    'date_post' => date("Y-m-d H:i:s"),
                    'foto' => $image_data['file_name'],
                    'action_produk' => 0,
                    'action_port' => 0,
                    'action_berita' => 0,
                    'slide' => 0,
                    'penerbit' => 'ADMIN',
                );

                $this->db->insert('post', $data);
                $last_id = $this->db->insert_id();

                $datacov = array(
                    'nama_foto' => $this->input->post('judul'),

                    'foto' => $image_data['file_name'],
                    'produk_id' => $last_id,
                );
                $insert = $this->katalog->input_konten($datacov);
                echo json_encode($insert);
            }
        }
    }

    public function fileUpload()
    {
        if (!empty($_FILES['file']['name'])) {

            // Set preference
            $config['upload_path'] = './assets/upload/artikel/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite'] = true;
            $config['max_size'] = 3024; // 1MB
            $config['file_name'] = $_FILES['file']['name'];

            //Load upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            // File upload

            if ($this->upload->do_upload('file')) {
                $id = $this->input->post('produk_id');
                $image_data = $this->upload->data();
                $token = 2;
                $data = array(
                    'foto' => $image_data['file_name'],
                    'produk_id' => $this->input->post('id'),
                    'token' => $token,
                );
                $insert =  $this->katalog->uploadFile($data, $id);
                echo json_encode($insert);
            }
        }
    }


    public function editkonten($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->katalog->get_kontenByid($id);
            echo json_encode($data);
        }
    }

    public function update_konten()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $slug = str_replace(' ', '-', $this->input->post('judul'));

            if (!empty($_FILES["foto"]["name"])) {
                $config['upload_path'] = './assets/upload/artikel/';
                $config['file_name'] = strtolower($slug) . '-' . time();
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
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
                    //direktori file
                    $path = './assets/upload/artikel/';
                    $filename = $this->input->post('old_foto');
                    //hapus file
                    if (file_exists($path . $filename)) {
                        unlink($path . $filename);
                    }

                    $data = array(
                        'judul' => $this->input->post('judul'),
                        'slug'          => strtolower($slug),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'kategori' => $this->input->post('kategori'),
                        'konten' => $this->input->post('konten'),
                        'foto'          => $image_data['file_name'],

                    );
                }
            } else {
                $data = array(
                    'judul' => $this->input->post('judul'),
                    'slug'          => strtolower($slug),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'kategori' => $this->input->post('kategori'),
                    'konten' => $this->input->post('konten'),
                );
            }

            $update = $this->katalog->update(array('id' => $this->input->post('id')), $data);
            echo json_encode($update);
        }
    }

    public function delete_data($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $this->katalog->delete_by_id($id);
        }
    }
    public function delete_foto($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $this->katalog->delete_foto_id($id);
        }
    }



    public function slide_on($id)
    {
        $id_testi = $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'slide' => 1,
            );
        }
        $update = $this->katalog->switch($id_testi, $data);
        echo json_encode($update);
    }
    public function produk_on($id)
    {
        $id_testi = $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'action_produk' => 1,
            );
        }
        $update = $this->katalog->switch($id_testi, $data);
        echo json_encode($update);
    }
    public function port_on($id)
    {
        $id_testi = $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'action_port' => 1,
            );
        }
        $update = $this->katalog->switch($id_testi, $data);
        echo json_encode($update);
    }
    public function berita_on($id)
    {
        $id_testi = $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'action_berita' => 1,
            );
        }
        $update = $this->katalog->switch($id_testi, $data);
        echo json_encode($update);
    }
    public function slide_of($id)
    {
        $id_testi = $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'slide' => 0,
            );
        }
        $update = $this->katalog->switch($id_testi, $data);
        echo json_encode($update);
    }
    public function produk_of($id)
    {
        $id_testi = $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'action_produk' => 0,
            );
        }
        $update = $this->katalog->switch($id_testi, $data);
        echo json_encode($update);
    }

    public function port_of($id)
    {
        $id_testi = $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'action_port' => 0,
            );
        }
        $update = $this->katalog->switch($id_testi, $data);
        echo json_encode($update);
    }
    public function berita_of($id)
    {
        $id_testi = $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'action_berita' => 0,
            );
        }
        $update = $this->katalog->switch($id_testi, $data);
        echo json_encode($update);
    }
}
