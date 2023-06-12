<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_gallery', 'gallery');
        $this->load->model('admin/Profil_m', 'profil');

        $autoload['helper'] = array('text');
        $this->load->library('session');
    }
    public function index()
    {


        $data = [

            'judul' => 'Gallery | ' . $this->profil->get_profile('nama'),
            'perusahaan' => $this->profil->get_profile('nama'),
            'url' => $this->profil->get_profile('web_url'),
            'slogan' => $this->profil->get_profile('slogan'),
            'company_name' => $this->profil->get_profile('company_name'),
            'logo' => $this->profil->get_profile('logo'),
            'alamat' => $this->profil->get_profile('alamat'),
            'whatsap' => $this->profil->get_kontak('whatsap'),
            'facebook' => $this->profil->get_kontak('facebook'),
            'instagram' => $this->profil->get_kontak('instagram'),
            'email' => $this->profil->get_kontak('email'),
            'telpon' => $this->profil->get_kontak('telpon'),
            'foto' => $this->profil->get_profile('foto'),
            'deskripsi' => $this->profil->get_profile('deskripsi'),
            'gallery' => $this->gallery->get_gallery()->result(),

            'B_produk' => $this->profil->get_B_produk()->result(),
            'produklimit' => $this->profil->produklimit()->result(),
            'artikellimit' => $this->profil->art()->result(),


            // 'kategori' => $this->katalog->get_kategori()->result(),

        ];



        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('pages/gallery_v', $data);
        $this->load->view('layout/footer', $data);
    }
}
