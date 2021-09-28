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
        $this->db->from('subkriteria');
        $this->db->order_by('id_subkriteria', 'ASC');
        return $this->db->get();
    }

    public function tambahDataKriteria($post)
    {
        $data = [
            'id' => '',
            'id_kriteria' => $post['id_kriteria'],
            'kriteria' => $post['i_kriteria'],
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
