<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function login()
    {
        $data['judul'] = 'Login';
        $this->load->view('login', $data);
    }
    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {
            $this->load->model('user_model');
            $query = $this->user_model->login($post);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $params = array(
                    'iduser' => $row->id_user,
                    'level' => $row->level
                );
                $this->session->set_userdata($params);
                echo "<script>
                window.location='" . site_url('landing') . "';
                </script>";
            } else {
                echo "<script>
                alert('Login Gagal, Username/Password Salah');
                window.location='" . site_url('auth/login') . "';
                </script>";
            }
        }
    }

    public function logout()
    {
        $params = array('iduser', 'level');
        $this->session->set_userdata($params);
        redirect('auth/login');
    }
}
