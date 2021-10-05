<?php

class Inputkriteria_model extends CI_Model
{
    public function getAllKriteria()
    {
        $this->db->from('kriteria');
        $this->db->order_by('id_kriteria', 'ASC');
        $query = $this->db->get();  // Produces: SELECT * FROM mytable
        return $query;
    }

    public function getAllSubKriteria()
    {
        // $this->db->from('subkriteria');
        // $this->db->join('kriteria', 'subkriteria.id_kriteria = kriteria.id');
        // $this->db->order_by('id_subkriteria', 'ASC');
        // return $this->db->get();

        $query = "SELECT subkriteria.id_subkriteria, subkriteria.subkriteria, kriteria.kriteria, kriteria.id_kriteria as id_kriteria, subkriteria.bobot FROM subkriteria JOIN kriteria ON subkriteria.id_kriteria = kriteria.id";

        return $this->db->query($query);
    }

    public function tambahDataSubKriteria($post)
    {
        $data = [
            'id_subkriteria' => NULL,
            'subkriteria' => $post['subkriteria'],
            'id_kriteria' => $post['id_kriteria'],
            'bobot' => $post['bobot']
        ];

        $this->db->insert('subkriteria', $data);
    }

    public function tambahDataKriteria($post)
    {
        $data = [
            'id' => '',
            'id_kriteria' => $post['id_kriteria'],
            'kriteria' => $post['subkriteria'],
        ];

        $this->db->insert('kriteria', $data);
    }

    public function updateDataKriteria($post)
    {
        $data = [
            'id_kriteria' => $post['up_kriteria'],
            'kriteria' => $post['u_kriteria'],
        ];

        $this->db->where('id_kriteria', $post['id']);
        $this->db->update('kriteria', $data);
    }

    function deleteDataKriteria($id)
    {
        $this->db->where('id_kriteria', $id);
        $this->db->delete('kriteria');
    }
}
