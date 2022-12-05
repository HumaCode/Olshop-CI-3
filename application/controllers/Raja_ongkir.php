<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Raja_ongkir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_setting');
    }


    private $api_key = 'efb629ffd0f0ce71775f541631c31c4a';

    public function provinsi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // echo $response;
            $array_response = json_decode($response, true);
            // echo '<pre>';
            // print_r($array_response['rajaongkir']['results']);
            // echo '</pre>';

            $data_provinsi = $array_response['rajaongkir']['results'];

            echo "<option value=''>--> Pilih Provinsi <--</option>";

            // lakukan perulangan.
            foreach ($data_provinsi as $provinsi) {
                echo "<option value='" . $provinsi['province'] . "' id_provinsi='" . $provinsi['province_id'] . "'>" . $provinsi['province'] . "</option>";
            }
        }
    }

    public function kota()
    {
        $id_provinsi_terpilih = $this->input->post('id_provinsi');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi_terpilih,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, true);

            $data_kota = $array_response['rajaongkir']['results'];

            echo "<option value=''>--> Pilih Kota <--</option>";

            // lakukan perulangan.
            foreach ($data_kota as $kota) {
                echo "<option value='" . $kota['city_name'] . "' id_kota='" . $kota['city_id'] . "'>" . $kota['city_name'] . "</option>";
            }
        }
    }

    public function expedisi()
    {
        echo '<option value="">-->Pilih Expedisi<--</option>';
        echo '<option value="jne">JNE</option>';
        echo '<option value="tiki">Tiki</option>';
        echo '<option value="pos">Pos Indonesia</option>';
    }

    public function paket()
    {
        // buat variabel untuk memanggil data tb_toko dari model setting(m_setting).
        // ambil dat alokasinya saja, seperti berikut.
        // kemudian variabel id_lokasi_saya pindahkan ke beris no 134.
        $id_kota_saya = $this->m_setting->data_setting()['lokasi'];

        // ambil data dari post javascript.
        $expedisi   = $this->input->post('expedisi');
        $id_kota    = $this->input->post('id_kota');
        $berat      = $this->input->post('berat');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",

            // ubah data sesuai dengan inputan.
            CURLOPT_POSTFIELDS => "origin=" . $id_kota_saya . "&destination=" . $id_kota . "&weight=" . $berat . "&courier=" . $expedisi . "",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // ubah menjadi bahasa json.
            $array_response = json_decode($response, true);

            // echo '<pre>';
            // print_r($array_response['rajaongkir']['results'][0]['costs']);
            // echo '</pre>';

            $data_paket = $array_response['rajaongkir']['results'][0]['costs'];
            echo "<option value=''>-->Pilih Paket<--</option>";

            // lakukan perulangan.
            // didalam option kita akan menampilkan jumlah harga, dan estimasi pengiriman, maka seperti berikut.
            // jika expedisinya menggunakan pos indonesia, maka tidak perlu memakai hari.
            if ($expedisi == 'pos') {
                $hari = '';
            } else {
                $hari = ' Hari';
            }

            foreach ($data_paket as $data) {
                echo "<option value='" . $data['service'] . "' ongkir='"  . $data['cost'][0]['value'] . "'estimasi='"  . $data['cost'][0]['etd'] . " $hari'> " . $data['service'] . " | Rp. " . number_format($data['cost'][0]['value'], 0, ',', '.') . " | " . $data['cost'][0]['etd'] . "$hari</option>";
            }
        }
    }
}
