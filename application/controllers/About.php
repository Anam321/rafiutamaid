<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_about', 'about');
        $this->load->model('admin/Profil_m', 'profil');
        $this->load->model('M_home', 'home');

        $this->load->library('session');
    }
    public function index()
    {


        $data = [

            'judul' => $this->profil->get_profile('title'),
            'perusahaan' => $this->profil->get_profile('nama'),
            'url' => $this->profil->get_profile('web_url'),
            'tentang' => $this->profil->get_profile('tentang'),
            'video' => $this->profil->get_profile('video'),
            'Produk' => $this->home->get_produk()->result(),
            'portfolio' => $this->home->get_portfolio()->result(),
            'berita' => $this->home->get_berita()->result(),
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


        ];
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('pages/about_v', $data);
        $this->load->view('layout/footer', $data);
    }
}
