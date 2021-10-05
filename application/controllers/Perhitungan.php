<?php defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inputperhitungan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Data Perhitungan';
        $this->template->load('template', 'perhitungan/index', $data);
    }

    public function ajax()
    {
        $data = $this->Inputperhitungan_model->getAllPerhitungan();

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['insert'])) {
            $this->Inputalternatif_model->tambahDataAlternatif($post);
            redirect('alternatif');
        }
        if (isset($post['update'])) {
            $this->Inputalternatif_model->updateDataAlternatif($post);
            redirect('alternatif');
        } else {
            redirect('alternatif');
        }
    }

    function delete($id)
    {
        $this->Inputalternatif_model->deleteDataAlternatif($id);
        redirect('alternatif');
    }
}
