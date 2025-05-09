<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class FuzzyMamdani
{
    private $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function fuzzy_dynamic($value, $id_kriteria)
    {
        $sql  = "SELECT * FROM tb_skala WHERE id_kriteria = $id_kriteria";
        $qry  = $this->ci->db->query($sql);
        $data = $qry->result_array();

        $fuzzy_values = [];

        foreach ($data as $key => $row) {
            $nama         = strtolower($row['nama']);
            $batas_bawah  = $row['batas_bawah'];
            $batas_tengah = $row['batas_tengah'];
            $batas_atas   = $row['batas_atas'];

            if (!is_null($batas_bawah) && !is_null($batas_tengah) && !is_null($batas_atas)) {
                if ($value <= $batas_bawah || $value >= $batas_atas) {
                    $fuzzy_values[$nama] = 0;
                } elseif ($value > $batas_bawah && $value < $batas_tengah) {
                    $fuzzy_values[$nama] = ($value - $batas_bawah) / ($batas_tengah - $batas_bawah);
                } elseif ($value > $batas_tengah && $value < $batas_atas) {
                    $fuzzy_values[$nama] = ($batas_atas - $value) / ($batas_atas - $batas_tengah);
                } else {
                    $fuzzy_values[$nama] = 1;
                }
            } else if (!is_null($batas_bawah) && !is_null($batas_tengah) && is_null($batas_atas)) {
                if ($value <= $batas_bawah) {
                    $fuzzy_values[$nama] = 1;
                } elseif ($value > $batas_bawah && $value < $batas_tengah) {
                    $fuzzy_values[$nama] = ($batas_tengah - $value) / ($batas_tengah - $batas_bawah);
                } else {
                    $fuzzy_values[$nama] = 0;
                }
            } else if (is_null($batas_bawah) && !is_null($batas_tengah) && !is_null($batas_atas)) {
                if ($value <= $batas_tengah) {
                    $fuzzy_values[$nama] = 0;
                } elseif ($value > $batas_tengah && $value < $batas_atas) {
                    $fuzzy_values[$nama] = ($value - $batas_tengah) / ($batas_atas - $batas_tengah);
                } else {
                    $fuzzy_values[$nama] = 1;
                }
            } else {
                $fuzzy_values[$nama] = 0;
            }

            $fuzzy_values[$nama] = round($fuzzy_values[$nama], 2);
        }

        return $fuzzy_values;
    }

    function fuzzy_inferensi($mu, $bobot)
    {
        $sql4 = "SELECT tk.id_kriteria, tk.nama AS kriteria, tkb.nama AS bobot, tkb.batas_bawah, tkb.batas_tengah, tkb.batas_atas FROM tb_kriteria AS tk LEFT JOIN tb_skala AS tkb ON tkb.id_kriteria = tk.id_kriteria WHERE jenis = 'output' AND tkb.nama = '$bobot'";
        $query3 = $this->ci->db->query($sql4);
        $data2 = $query3->result_array();

        foreach ($data2 as $key => $row) {
            $batas_bawah  = $row['batas_bawah'];
            $batas_tengah = $row['batas_tengah'];
            $batas_atas   = $row['batas_atas'];

            if (!is_null($batas_bawah) && !is_null($batas_tengah) && is_null($batas_atas)) {
                $z = ($mu * ($batas_tengah - $batas_bawah)) + $batas_bawah;
            } else if (is_null($batas_bawah) && !is_null($batas_tengah) && !is_null($batas_atas)) {
                $z = ($mu * ($batas_atas - $batas_tengah)) + $batas_tengah;
            } else {
                $z = 0; // Kasus tidak valid
            }
        }

        return round($z, 2);
    }
}
