<?php

class Inputpenduduk_model extends CI_Model
{
    public function getKriteria($id_kriteria)
    {
        $query = "SELECT kriteria.id_kriteria, subkriteria.subkriteria, subkriteria.bobot FROM kriteria JOIN subkriteria ON kriteria.id = subkriteria.id_kriteria WHERE kriteria.id_kriteria = '$id_kriteria'";

        return $this->db->query($query);
    }

    public function checkKK($KK)
    {
        return $this->db->get_where('penduduk', ['no_kk' => $KK])->row_array();
    }

    public function getAllPenduduk()
    {
        $this->db->from('penduduk');
        $this->db->order_by('no_kk', 'ASC');
        $query = $this->db->get();  // Produces: SELECT * FROM mytable
        return $query;
    }

    public function tambahDataPenduduk($post)
    {
        $data = [
            'no_kk' => $post['i_penduduk'],
            'nik' => $post['j_penduduk'],
            'nama' => $post['k_penduduk'],
            'jenis_kelamin' => $post['l_penduduk'],
            'alamat' => $post['o_penduduk'],
            'bekerja' => $post['p_penduduk'],
            'riwayat_penyakit' => $post['q_penduduk'],
            'bansos_Diterima' => $post['r_penduduk'],
        ];

        $this->db->insert('penduduk', $data);
    }

    public function updateDataPenduduk($post)
    {
        $data = [
            'no_kk' => $post['a_penduduk'],
            'nik' => $post['b_penduduk'],
            'nama' => $post['c_penduduk'],
            'jenis_kelamin' => $post['d_penduduk'],
            'alamat' => $post['g_penduduk'],
            'bekerja' => $post['h_penduduk'],
            'riwayat_penyakit' => $post['x_penduduk'],
            'bansos_Diterima' => $post['y_penduduk'],
        ];

        $this->db->where('no_kk', $post['id']);
        $this->db->update('penduduk', $data);
    }

    function deleteDataPenduduk($id)
    {
        $this->db->where('no_kk', $id);
        $this->db->delete('penduduk');
    }
}
