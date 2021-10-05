<?php defined('BASEPATH') or exit('No direct script access allowed');

class Penduduk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inputpenduduk_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Data Penduduk';
        $data['row'] = $this->Inputpenduduk_model->getAllPenduduk();
        $data['kriteria_penyakit'] = $this->Inputpenduduk_model->getKriteria('C3');
        $data['kriteria_kerja'] = $this->Inputpenduduk_model->getKriteria('C2');
        $data['kriteria_bansos'] = $this->Inputpenduduk_model->getKriteria('C1');
        $this->template->load('template', 'penduduk/input_penduduk', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['insert'])) {
            $this->Inputpenduduk_model->tambahDataPenduduk($post);
            redirect('penduduk');
        }
        if (isset($post['update'])) {
            $this->Inputpenduduk_model->updateDataPenduduk($post);
            redirect('penduduk');
        } else {
            redirect('penduduk');
        }
    }

    function delete($id)
    {
        $this->Inputpenduduk_model->deleteDataPenduduk($id);
        redirect('penduduk');
    }
}
