<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_portfolio extends CI_Model
{

    public function get_portfolio_konten()
    {
        $this->db->select('*');
        $this->db->from('post');
        // $this->db->where('token', 1);
        $this->db->where('action_port', 1);
        $this->db->order_by('id', 'DESC');
        // $this->db->limit(12);
        $query = $this->db->get();
        return $query;
    }
    public function get_produkWidget()
    {
        $this->db->select('*');
        $this->db->from('post');
        // $this->db->where('token', 1);
        $this->db->where('action_produk', 1);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(25);
        $query = $this->db->get();
        return $query;
    }





    public function get_produk()
    {
        $this->db->select('*');
        $this->db->from('post');
        // $this->db->where('token', 1);
        $this->db->where('action_produk', 1);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        return $query;
    }

    public function get_portfolioByslug($slug)
    {
        $this->db->select('*');
        $this->db->from('post');
        // $this->db->where('token', 1);
        $this->db->where('slug', $slug);
        $this->db->order_by('id', 'DESC');
        // $this->db->limit(12);
        $query = $this->db->get();
        return $query;
    }


    public function get_portfolio()
    {
        $this->db->select('*');
        $this->db->from('post');
        // $this->db->where('token', 1);
        $this->db->where('action_port', 1);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(12);
        $query = $this->db->get();
        return $query;
    }
    public function get_berita()
    {
        $this->db->select('*');
        $this->db->from('post');
        // $this->db->where('token', 1);
        $this->db->where('action_berita', 1);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        return $query;
    }

    public function get_kategori()
    {
        $this->db->select('*');
        $this->db->from('tweb_kategori');
        //$this->db->order_by('produk_id', 'DESC');
        //$this->db->limit(6);
        $query = $this->db->get();
        return $query;
    }





    public function insertTracking($data)
    {
        $this->db->insert('whatsapptracking', $data);
    }
    public function input_visit($data)
    {
        $this->db->insert('section_visit', $data);
    }
}
