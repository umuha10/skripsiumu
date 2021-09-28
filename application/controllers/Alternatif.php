<?php defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inputalternatif_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Data Alternatif';
        $data['row'] = $this->Inputalternatif_model->getAllAlternatif();
        $this->template->load('template', 'alternatif/input_alternatif', $data);
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
