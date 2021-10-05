<?php

class Inputperhitungan_model extends CI_Model
{
    public function getAllPerhitungan()
    {
        $query = "SELECT penduduk.no_kk, penduduk.nik, penduduk.nama, penduduk.bekerja, penduduk.riwayat_penyakit, penduduk.bansos_diterima FROM penduduk";

        return $this->db->query($query)->result_array();
    }
}
