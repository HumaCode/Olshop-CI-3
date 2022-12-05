<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function login_user()
    {
        // set rules
        $this->form_validation->set_rules('username', 'Username', 'required', ['required' => '%s Harus Diisi.!!']);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => '%s Harus Diisi.!!']);

        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // ambil function login dari library.
            $this->user_login->login($username, $password);
        } else {
            $data = [
                'title' => 'Login User'
            ];

            $this->load->view('v_login_user', $data, false);
        }
    }

    public function logout_user()
    {
        $this->user_login->logout();
    }
}
