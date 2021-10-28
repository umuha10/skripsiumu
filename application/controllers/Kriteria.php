<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inputkriteria_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Data Kriteria';
        $data['row'] = $this->Inputkriteria_model->getAllKriteria();
        $this->template->load('template', 'kriteria/input_kriteria', $data);
    }

    public function subkriteria()
    {
        $data['judul'] = 'Data Sub Kriteria';
        $data['kriteria'] = $this->Inputkriteria_model->getAllKriteria();
        $data['row'] = $this->Inputkriteria_model->getAllSubKriteria();
        $this->template->load('template', 'subkriteria/input_subkriteria', $data);
    }

    public function proses($page = NULL)
    {
        $post = $this->input->post(null, TRUE);
        if ($page == "subkriteria") {
            // var_dump($page);
            if (isset($post['insert'])) {
                $this->Inputkriteria_model->tambahDataSubKriteria($post);
                redirect('kriteria/subkriteria');
            }
            if (isset($post['update'])) {
                $this->Inputkriteria_model->updateDataSubKriteria($post);
                redirect('kriteria/subkriteria');
            } else {
                redirect('kriteria/subkriteria');
            }
        } else {
            if (isset($post['insert'])) {
                $this->Inputkriteria_model->tambahDataKriteria($post);
                redirect('kriteria');
            }
            if (isset($post['update'])) {
                $this->Inputkriteria_model->updateDataKriteria($post);
                redirect('kriteria');
            } else {
                redirect('kriteria');
            }
        }
    }

    function delete($id)
    {
        $this->Inputkriteria_model->deleteDataKriteria($id);
        redirect('kriteria');
    }
}
