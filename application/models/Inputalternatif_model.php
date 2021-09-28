<?php

class Inputalternatif_model extends CI_Model
{
    public function getAllAlternatif()
    {
        $this->db->from('alternatif');
        $this->db->order_by('id_alternatif', 'ASC');
        $query = $this->db->get();  // Produces: SELECT * FROM mytable
        return $query;
    }

    public function tambahDataAlternatif($post)
    {
        $data = [
            'id_alternatif' => $post['id_alternatif'],
            'nama_alternatif' => $post['i_alternatif'],
            'bobot' => $post['in_alternatif'],
        ];

        $this->db->insert('alternatif', $data);
    }

    public function updateDataAlternatif($post)
    {
        $data = [
            'id_alternatif' => $post['ud_alternatif'],
            'nama_alternatif' => $post['u_alternatif'],
            'bobot' => $post['up_alternatif'],
        ];

        $this->db->where('id_alternatif', $post['id']);
        $this->db->update('alternatif', $data);
    }

    function deleteDataAlternatif($id)
    {
        $this->db->where('id_alternatif', $id);
        $this->db->delete('alternatif');
    }
}
