<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_barang');
        $this->load->model('m_kategori');
    }


    public function index()
    {
        $data = [
            'title'     => 'Barang',
            'barang'    => $this->m_barang->get_all_barang(),
            'isi'       => 'barang/v_barang'
        ];

        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function tambah_barang()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim', ['required' => '%s Harus Diisi.!!']);
        $this->form_validation->set_rules('berat', 'Berat', 'required|trim', ['required' => '%s Harus Diisi.!!']);
        $this->form_validation->set_rules('stok', 'stok', 'required|trim', ['required' => '%s Harus Diisi.!!']);
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim', ['required' => '%s Harus Diisi.!!']);
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim', ['required' => '%s Harus Diisi.!!']);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ['required' => '%s Harus Diisi.!!']);

        if ($this->form_validation->run() == true) {

            // upload gambar.
            $config['upload_path']      = './assets/img/produk/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2000';

            $this->upload->initialize($config);

            $field_name = "gambar";
            // jika tidak melakukan upload, maka tmpilkan halaman tambah.
            if (!$this->upload->do_upload($field_name)) {
                $data = [
                    'title'         => 'Tambah Data Barang',
                    'kategori'      => $this->m_kategori->get_all_kategori(),
                    'error_upload'  => $this->upload->display_errors(),
                    'isi'           => 'barang/v_tambah_barang'
                ];

                $this->load->view('layout/v_wrapper_backend', $data, false);
            } else {

                // melakukan upload.
                $upload_data    = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/produk/' . $upload_data['uploads']['file_name'];

                $this->load->library('image_lib', $config);

                $data = [
                    'nama_barang'   => $this->input->post('nama_barang'),
                    'id_kategori'   => $this->input->post('nama_kategori'),
                    'harga'         => $this->input->post('harga'),
                    'deskripsi'     => $this->input->post('deskripsi'),
                    'gambar'        => $upload_data['uploads']['file_name'],
                    'berat'         => $this->input->post('berat'),
                    'stok'          => $this->input->post('stok')
                ];

                $this->m_barang->add($data);
                $this->session->set_flashdata('pesan', 'Data barang berhasil ditambahkan');
                redirect('barang');
            }
        }

        $data = [
            'title'         => 'Tambah Data Barang',
            'kategori'      => $this->m_kategori->get_all_kategori(),
            'isi'           => 'barang/v_tambah_barang'
        ];

        $this->load->view('layout/v_wrapper_backend', $data, false);
    }


    public function edit($id_barang)
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim', ['required' => '%s Harus Diisi.!!']);
        $this->form_validation->set_rules('berat', 'Berat', 'required|trim', ['required' => '%s Harus Diisi.!!']);
        $this->form_validation->set_rules('stok', 'stok', 'required|trim', ['required' => '%s Harus Diisi.!!']);
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim', ['required' => '%s Harus Diisi.!!']);
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim', ['required' => '%s Harus Diisi.!!']);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ['required' => '%s Harus Diisi.!!']);

        if ($this->form_validation->run() == true) {

            // upload gambar.
            $config['upload_path']      = './assets/img/produk/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2000';

            $this->upload->initialize($config);

            $field_name = "gambar";
            // jika tidak melakukan upload, maka tmpilkan halaman tambah.
            if (!$this->upload->do_upload($field_name)) {
                $data = [
                    'title'         => 'Edit Data Barang',
                    'kategori'      => $this->m_kategori->get_all_kategori(),
                    'barang'        => $this->m_barang->get_barang_by_id($id_barang),
                    'error_upload'  => $this->upload->display_errors(),
                    'isi'           => 'barang/v_edit'
                ];

                $this->load->view('layout/v_wrapper_backend', $data, false);
            } else {

                // melakukan upload.
                $upload_data    = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/produk/' . $upload_data['uploads']['file_name'];



                $this->load->library('image_lib', $config);



                $data = [
                    'id_barang'     => $id_barang,
                    'nama_barang'   => $this->input->post('nama_barang'),
                    'id_kategori'   => $this->input->post('nama_kategori'),
                    'harga'         => $this->input->post('harga'),
                    'deskripsi'     => $this->input->post('deskripsi'),
                    'gambar'        => $upload_data['uploads']['file_name'],
                    'berat'         => $this->input->post('berat'),
                    'stok'          => $this->input->post('stok')
                ];

                // jika gambarnya di edit, maka gambar lama akan di hapus dari folder.
                $barang = $this->m_barang->get_barang_by_id($id_barang);
                if ($data['gambar'] != "") {
                    unlink('./assets/img/produk/' . $barang['gambar']);
                }


                $this->m_barang->edit($data);
                $this->session->set_flashdata('pesan', 'Data barang berhasil diedit');
                redirect('barang');
            }
            // jika adminn mengedit data tanpa mengganti gambar.
            $data = [
                'id_barang'     => $id_barang,
                'nama_barang'   => $this->input->post('nama_barang'),
                'id_kategori'   => $this->input->post('nama_kategori'),
                'harga'         => $this->input->post('harga'),
                'deskripsi'     => $this->input->post('deskripsi'),
                'berat'         => $this->input->post('berat'),
                'stok'          => $this->input->post('stok')
            ];

            $this->m_barang->edit($data);
            $this->session->set_flashdata('pesan', 'Data barang berhasil diedit');
            redirect('barang');
        }

        $data = [
            'title'         => 'Edit Data Barang',
            'kategori'      => $this->m_kategori->get_all_kategori(),
            'barang'        => $this->m_barang->get_barang_by_id($id_barang),
            'isi'           => 'barang/v_edit'
        ];

        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function delete($id_barang)
    {
        // hapus gambar dalam folder.
        $barang = $this->m_barang->get_barang_by_id($id_barang);

        if ($barang['gambar'] != "") {
            unlink('./assets/img/produk/' . $barang['gambar']);
        }

        $data = [
            'id_barang' => $id_barang
        ];

        $this->m_barang->delete($data);
        $this->session->set_flashdata('pesan', 'Data barang berhasil hapus');
        redirect('barang');
    }
}
