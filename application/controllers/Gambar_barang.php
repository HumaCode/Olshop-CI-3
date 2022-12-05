<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gambar_barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_gambarBarang');
        $this->load->model('m_barang');
    }


    public function index()
    {
        $data = [
            'title'     => 'Gambar Barang',
            'gambar'    => $this->m_gambarBarang->get_all_gambar_barang(),
            'isi'       => 'gambarBarang/v_index'
        ];

        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function tambah($id_barang)
    {
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', ['required' => '%s Harus Diisi.!!']);


        if ($this->form_validation->run() == true) {

            // upload gambar.
            $config['upload_path']      = './assets/img/produk-detail/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2000';

            $this->upload->initialize($config);

            $field_name = "gambar";
            // jika tidak melakukan upload, maka tmpilkan halaman tambah.
            if (!$this->upload->do_upload($field_name)) {
                $data = [
                    'title'         => 'Tambah Gambar Barang',
                    'error_upload'  => $this->upload->display_errors(),
                    'gambar'        => $this->m_gambarBarang->get_gambar_barang_by_id($id_barang),
                    'barang'        => $this->m_barang->get_barang_by_id($id_barang),
                    'isi'           => 'gambarBarang/v_tambah'
                ];

                $this->load->view('layout/v_wrapper_backend', $data, false);
            } else {

                // melakukan upload.
                $upload_data    = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/produk-detail/' . $upload_data['uploads']['file_name'];

                $this->load->library('image_lib', $config);

                $data = [
                    'id_barang'     => $id_barang,
                    'keterangan'     => $this->input->post('keterangan'),
                    'gambar'        => $upload_data['uploads']['file_name']
                ];

                $this->m_gambarBarang->tambah($data);
                $this->session->set_flashdata('pesan', 'Gambar barang berhasil ditambahkan');
                redirect('gambar_barang/tambah/' . $id_barang);
            }
        }


        $data = [
            'title'     => 'Tambah Gambar Barang',
            'gambar'    => $this->m_gambarBarang->get_gambar_barang_by_id($id_barang),
            'barang'    => $this->m_barang->get_barang_by_id($id_barang),
            'isi'       => 'gambarBarang/v_tambah'
        ];

        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function delete($id_barang, $id_gambar)
    {
        // hapus gambar dalam folder.
        $gambar = $this->m_gambarBarang->get_gambar_barang($id_gambar);

        if ($gambar['gambar'] != "") {
            unlink('./assets/img/produk-detail/' . $gambar['gambar']);
        }

        $data = [
            'id_gambar' => $id_gambar
        ];

        $this->m_gambarBarang->delete($data);
        $this->session->set_flashdata('pesan', 'Gambar berhasil hapus');
        redirect('gambar_barang/tambah/' . $id_barang);
    }
}
