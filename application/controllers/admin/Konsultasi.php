<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);
    }

    public function index()
    {
        $data = [
            'kriteria' => $this->m_kriteria->list_jenis('input')->result(),
        ];

        $this->template->load('admin', 'Konsultasi', 'konsultasi', 'view', $data);
    }

    public function process()
    {
        $post = $this->input->post(NULL, TRUE);

        $id_kriteria = $post['id_kriteria'];
        $value       = $post['value'];

        $nilai = [];
        foreach ($id_kriteria as $key => $row) {
            $nilai[$row] = $value[$key];
        }

        // =========================================================================

        $data = $this->m_kriteria->list_jenis('input')->result_array();

        $konsultasi = [];
        $kriteria = [];
        foreach ($data as $key => $value) {
            $konsultasi[] = [
                'id_kriteria' => $value['id_kriteria'],
                'nama'        => $value['nama'],
                'nilai'       => $nilai[$value['id_kriteria']]
            ];

            $kriteria[$value['id_kriteria']] = $value['nama'];
        }

        $fuzzifikasi = [];
        foreach ($konsultasi as $key => $value) {
            $fuzzifikasi[$value['id_kriteria']] = $this->fuzzymamdani->fuzzy_dynamic($value['nilai'], $value['id_kriteria']);
        }

        // =========================================================================

        $data2 = $this->m_rule->list()->result_array();

        $inferensi = [];
        $currentRule = [];
        foreach ($data2 as $key => $row) {
            if ($row['kondisi'] == 'if') {
                $currentRule[] = $row;
            } elseif ($row['kondisi'] == 'then') {
                $currentRule[] = $row;
                $inferensi[] = $currentRule;
                $currentRule = [];
            }
        }

        $data3 = $this->m_skala->list_jenis('output')->result_array();

        $testing = [];
        $output_skala = [];
        foreach ($data3 as $key => $value) {
            $testing[] = strtolower($value['skala']);

            if ($value['batas_bawah'] !== null) {
                $output_skala[] = (float) $value['batas_bawah'];
            }

            if ($value['batas_tengah'] !== null) {
                $output_skala[] = (float) $value['batas_tengah'];
            }

            if ($value['batas_atas'] !== null) {
                $output_skala[] = (float) $value['batas_atas'];
            }
        }

        // debug('test', max($output_skala));

        $rules = [];
        foreach ($inferensi as $key => $rule) {
            $hasil    = '';
            $keys     = array_keys($rule);
            $firstKey = $keys[0];
            $lastKey  = $keys[count($keys) - 1];

            foreach ($rule as $key => $item) {
                if ($key == $firstKey) {
                    // Jika data pertama
                    $hasil .= "<b>JIKA</b> " . $item['kriteria'] . " => " . $item['skala'] . " ";
                } elseif ($key == $lastKey) {
                    // Jika data terakhir
                    $hasil .= "<b>MAKA</b> " . $item['skala'];
                } else {
                    // Selain itu (di tengah)
                    $hasil .= "<b>DAN</b> " . $item['kriteria'] . " => " . $item['skala'] . " ";
                }
            }

            $rules[] = $hasil;
        }

        // =========================================================================

        $hasil_inferensi = [];
        foreach ($inferensi as $key => $rule) {
            $hitung = [];
            $bobot  = '';

            foreach ($rule as $key => $value) {
                if ($value['kondisi'] == 'if') {
                    $bobot = strtolower($value['skala']);
                    $hitung[] = $fuzzifikasi[$value['id_kriteria']][$bobot];
                }

                if ($value['kondisi'] == 'then') {
                    $bobot = strtolower($value['skala']);
                }
            }

            $hasil_inferensi[] = [
                'hasil' => min($hitung),
                'rule'  => $bobot
            ];
        }

        $aaa = [];
        foreach ($testing as $key => $value) {
            foreach ($hasil_inferensi as $k => $row) {
                if ($row['rule'] == $value) {
                    $aaa[$key][] = $row['hasil'];
                }
            }
        }

        $bbb = [];

        $nilai_z = [];

        foreach ($testing as $key => $value) {
            $xxx = max($aaa[$key]);

            $bbb[$key] = $xxx;

            $nilai_z[$key] = $this->fuzzymamdani->fuzzy_inferensi($xxx, $value);
        }

        $arr_m1 = [
            min($nilai_z),
            0,
        ];

        $arr_m2 = $nilai_z;
        rsort($arr_m2);

        $arr_m3 = [
            max($output_skala),
            max($nilai_z),
        ];

        $m1 = [];
        foreach ($arr_m1 as $key => $val) {
            $m1[] = (min($bbb) * pow($val, 2) / 2);
        }

        $m2 = [];
        foreach ($arr_m2 as $key => $val) {
            $m2[] = (min($bbb) * pow($val, 2) / 2);
        }

        $m3 = [];
        foreach ($arr_m3 as $key => $val) {
            $m3[] = (max($bbb) * pow($val, 2) / 2);
        }

        $count_m1 = 0;
        for ($i = 0; $i < count($m1) - 1; $i++) {
            $selisih = $m1[$i] - $m1[$i + 1];
            $count_m1 = $selisih;
        }

        $count_m2 = 0;
        for ($i = 0; $i < count($m2) - 1; $i++) {
            $selisih = $m2[$i] - $m2[$i + 1];
            $count_m2 = $selisih;
        }

        $count_m3 = 0;
        for ($i = 0; $i < count($m3) - 1; $i++) {
            $selisih = $m3[$i] - $m3[$i + 1];
            $count_m3 = $selisih;
        }

        $a1 = min($bbb) * (min($nilai_z) - 0);
        $a2 = ((min($bbb) + max($bbb)) * (max($nilai_z) - min($nilai_z))) / 2;
        $a3 = max($bbb) * (max($output_skala) - max($nilai_z));

        $defuzzifikasi = ($count_m1 + $count_m2 + $count_m3) / ($a1 + $a2 + $a3);

        $momen = [
            $count_m1,
            $count_m2,
            $count_m3
        ];

        $luas = [
            $a1,
            $a2,
            $a3
        ];

        // =========================================================================

        $get_input  = $this->m_kriteria->list_jenis('input')->result_array();
        $get_output = $this->m_kriteria->list_jenis('output')->result_array();

        $input_string = [];
        foreach ($get_input as $key => $value) {
            $input_string[] = $value['nama'] . ' => ' . $nilai[$value['id_kriteria']];
        }

        $output_string = [];
        foreach ($get_output as $key => $value) {
            $output_string[] = $value['nama'] . ' => ' . $defuzzifikasi;
        }

        $inputStr   = implode(' DAN ', $input_string);
        $outputStr  = implode(' DAN ', $output_string);
        $kesimpulan = "JIKA $inputStr MAKA $outputStr";

        $data = [
            'konsultasi'      => $konsultasi,
            'kriteria'        => $kriteria,
            'fuzzifikasi'     => $fuzzifikasi,
            'rules'           => $rules,
            'hasil_inferensi' => $hasil_inferensi,
            'nilai_z'         => $nilai_z,
            'momen'           => $momen,
            'luas'            => $luas,
            'defuzzifikasi'   => $defuzzifikasi,
            'kesimpulan'      => $kesimpulan
        ];

        $this->template->load('admin', 'Hasil Konsultasi', 'konsultasi', 'result', $data);
    }
}
