<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('acak_id')) {
    function acak_id($table = NULL, $pk = NULL)
    {
        $CI = get_instance();
        $CI->load->helper('string');
        $id = 0;
        if ($table == NULL or $pk == NULL) return array('id' => $id);
        do {
            $id = mt_rand(1, 9) . random_string('numeric', 7);
            $slug = substr($id, 4, 3);
        } while ($CI->crud->cw($table, array($pk => $id)) > 0);
        return $id;
    }
}

if (!function_exists('get_kode_urut')) {
    function get_kode_urut($nmtbl, $key, $kd)
    {
        $CI     = get_instance();
        $result = $CI->db->select('*')->like($key, $kd)->get($nmtbl);
        $row    = $result->num_rows();

        if ($row != 0) {
            $kode  = $row + 1;
            $add_k = str_pad($kode, 3, "0", STR_PAD_LEFT);
            return "{$kd}{$add_k}";
        } else {
            return "{$kd}001";
        }
    }
}

if (!function_exists('get_kode_acak')) {
    function get_kode_acak()
    {
        $karakter = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $pass = [];
        $karakterLenght = strlen($karakter) - 1;
        for ($i = 0; $i < 7; $i++) {
            $n = rand(0, $karakterLenght);
            $pass[] = $karakter[$n];
        }
        return implode($pass);
    }
}

if (!function_exists('no_surat')) {
    function no_surat($nmtbl, $key, $kd)
    {
        $CI     = get_instance();
        $result = $CI->db->select('*')->like($key, $kd)->get($nmtbl);
        $row    = $result->num_rows();
        $bulan = date('m');
        $tahun = date('Y');

        if ($row != 0) {
            $kode  = $row + 1;
            $add_k = str_pad($kode, 3, "0", STR_PAD_LEFT);
            return "{$add_k}/{$kd}/PW.01/{$bulan}/{$tahun}";
        } else {
            return "001/{$kd}/PW.01/{$bulan}/{$tahun}";
        }
    }
}

// untuk hapus baris yang kosong
if (!function_exists('jika_baris_kosong')) {
    function jika_baris_kosong($row)
    {
        foreach ($row as $cell) {
            if (null !== $cell) return false;
        }
        return true;
    }
}

if (!function_exists('waktu')) {
    function waktu($wkt)
    {
        $jam = substr($wkt, 0, 2);
        $menit = substr($wkt, 3, 2);
        if ($jam < 12) {
            $AMPM = "AM";
            if ($jam == 0) $jam = 12;
        } else {
            $AMPM = "PM";
            if ($jam != 12) $jam = $jam - 12;
        }

        return $jam . ':' . $menit . ' ' . $AMPM;
    }
}

if (!function_exists('tgl_indo')) {
    function tgl_indo($tgl)
    {
        if ($tgl == "0000-00-00") {
            return "-";
        } else {
            $tanggal = substr($tgl, 8, 2);
            $bulan   = get_bulan(substr($tgl, 5, 2));
            $tahun   = substr($tgl, 0, 4);

            return $tanggal . ' ' . $bulan . ' ' . $tahun;
        }
    }
}

// untuk mengambil tahun
if (!function_exists('tahun')) {
    function tahun($start)
    {
        $getTahun = (int) date('Y');
        $tahun = [];

        for ($i = $start; $i <= $getTahun; $i++) {
            $tahun[] = $i;
        }

        return $tahun;
    }
}

if (!function_exists('format_tgl')) {
    function format_tgl($tgl, $indo = FALSE)
    {
        if (substr($tgl, 2, 1) == '-') { // ini format dd-mm-yyyy
            $tanggal = substr($tgl, 0, 2);
            $bulan = substr($tgl, 3, 2);
            $tahun = substr($tgl, 6, 4);
            return $tahun . '-' . $bulan . '-' . $tanggal;
        } else if (substr($tgl, 4, 1) == '-') { // ini format yyyy-mm-dd
            $tahun = substr($tgl, 0, 4);
            $bulan = substr($tgl, 5, 2);
            $tanggal = substr($tgl, 8, 2);
            return $indo ? $tanggal . ' ' . get_bulan($bulan) . ' ' . $tahun : $tanggal . '-' . $bulan . '-' . $tahun;
        }
    }
}

if (!function_exists('get_hari')) {
    function get_hari($day)
    {
        switch ($day) {
            case 0:
                return "Ahad";
                break;
            case 1:
                return "Senin";
                break;
            case 2:
                return "Selasa";
                break;
            case 3:
                return "Rabu";
                break;
            case 4:
                return "Kamis";
                break;
            case 5:
                return "Jumat";
                break;
            case 6:
                return "Sabtu";
                break;
        }
    }
}

if (!function_exists('get_bulan')) {
    function get_bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
}

if (!function_exists('number_to_roman')) {
    function number_to_roman($num)
    {
        $n = intval($num);
        $res = '';

        /*** roman_numerals array  ***/
        $roman_numerals = array(
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1
        );

        foreach ($roman_numerals as $roman => $number) {
            /*** divide to get  matches ***/
            $matches = intval($n / $number);

            /*** assign the roman char * $matches ***/
            $res .= str_repeat($roman, $matches);

            /*** substract from the number ***/
            $n = $n % $number;
        }

        /*** return the res ***/
        return $res;
    }
}

if (!function_exists('cari_query')) {
    function cari_query($q, $data)
    {
        $builder = "IFNULL($data[0], '') LIKE CONCAT('%', '$q', '%')";
        for ($i = 1; $i < sizeof($data); $i++) {
            $builder .= " OR IFNULL($data[$i], '') LIKE CONCAT('%', '$q', '%')";
        }
        return $builder;
    }
}

if (!function_exists('do_hash')) {
    function do_hash($data, $type = 'bcrypt')
    {
        if ($type == 'bcrypt') return password_hash($data, PASSWORD_BCRYPT);
        else if ($type == 'md5') return md5(md5($data . md5($data)));
    }
}

if (!function_exists('compare_hash')) {
    function compare_hash($data1, $data2, $sama)
    {
        if ($sama) $stat = ($data1 === $data2) ? TRUE : FALSE;
        else $stat = password_verify($data1, $data2);
        return $stat;
    }
}

if (!function_exists('set_lang')) {
    function set_lang($lang)
    {
        $cookie = array(
            'name'      => 'lang',
            'value'     => $lang,
            'expire'    => (60 /*detik*/ * 60 /*menit*/ * 24 /*jam*/ * 30 /*hari*/ * 12)
        );
        set_cookie($cookie);
    }
}

if (!function_exists('multiselect_tostring')) {
    function multiselect_tostring($string)
    {
        if (!is_array($string)) {
            if (($string == "") or ($string == null))
                return "";
            else
                return $string;
        } else {
            if (count($string) > 0) {
                // return TRUE;
                $string = implode(",", $string);
                return $string;
            } else {
                return "";
            }
        }
    }
}

if (!function_exists('is_array_empty')) {
    function is_array_empty($arr)
    {
        if (is_array($arr)) {
            foreach ($arr as $value) {
                if (!empty($value)) {
                    return false;
                }
            }
        }
        return true;
    }
}

if (!function_exists('flatten_json')) {
    function flatten_json(array $array)
    {
        $output = array();
        foreach ($array as $v) {
            $output[$v['id']] = $v['nama'];
        }
        return $output;
    }
}

if (!function_exists('check_active')) {
    function check_active($array, $active_class, $use_method = false)
    {
        $CI = get_instance();

        $modul = $CI->uri->segment(2);
        $method = $CI->uri->segment(3);

        if (!is_array($array)) {
            return '';
        }

        if ($use_method) {
            if (in_array($method, $array)) {
                return $active_class;
            } else {
                return '';
            }
        }
        if (in_array($modul, $array)) {
            return $active_class;
        } else {
            return '';
        }

        return '';
    }
}

if (!function_exists('rupiah')) {
    function rupiah($angka, $kurs = '')
    {
        if ($angka === '') {
            $angka = 0;
        }

        if ($kurs) {
            return $kurs . ' ' . number_format($angka);
        } else {
            return 'Rp ' . number_format($angka, 0, ',', '.') . ',-';
        }
    }
}

if (!function_exists('debug')) {
    function debug()
    {
        $numArgs = func_num_args();

        echo 'Total Arguments:' . $numArgs . "\n";

        $args = func_get_args();
        echo '<pre>';
        foreach ($args as $index => $arg) {
            echo 'Argument ke-' . $index . ':' . "\n";
            var_dump($arg);
            echo "\n";
            unset($args[$index]);
        }
        echo '</pre>';
        die();
    }
}

if (!function_exists('daterange_filter')) {
    function daterange_filter($date_range = array(), $pre = '')
    {
        $start = '';
        $end = '';
        if (empty($date_range))
            return false;

        if (($date_range['start'] === '' && $date_range['end'] !== '')) {
            $end = $pre . ' <= "' . $date_range['end'] . '"';
        } else if (($date_range['start'] !== '' && $date_range['end'] === '')) {
            $start = $pre . ' >= "' . $date_range['start'] . '"';
        } else if ($date_range['start'] === date("Y-m-d", strtotime('tomorrow')) && $date_range['end'] === date("Y-m-d", strtotime('tomorrow'))) {
            $end = $pre . ' <= "' . $date_range['end'] . '"';
        } else {
            if ($date_range['start'] === '' && $date_range['end'] === '') {
                $date_range['start'] = date("Y-m-d") . '  00:00:00';
                $date_range['end'] = date("Y-m-d") . ' 23:59:59';
            }
            $start =  $pre . ' >= "' . $date_range['start'] . '"' . ' AND ';
            $end = $pre . ' <= "' . $date_range['end'] . '"';
        }

        $where = $start . $end;
        return $where;
    }
}

if (!function_exists('secToTimes')) {
    function secToTimes($secs)
    {
        $t = round($secs);
        $jam = $t / 3600;
        $menit = $t / 60 % 60;
        $detik = $t % 60;
        if ($detik > 0) {
            return sprintf('%02d Jam %02d Menit %02d Detik', $jam, $menit, $detik);
        } else {
            return sprintf('%02d Jam %02d Menit', $jam, $menit);
        }
    }
}

if (!function_exists('base64url_encode')) {
    function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}

if (!function_exists('base64url_decode')) {
    function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}

if (!function_exists('getExtension')) {
    function getExtension($file)
    {
        $tmp = explode(".", $file);
        $extension = end($tmp);
        return $extension ? $extension : false;
    }
}

if (!function_exists('getAllDaysInAMonth')) {
    function getAllDaysInAMonth($year, $month, $day = 'Monday', $daysError = 3)
    {
        $dateString = 'first ' . $day . ' of ' . $year . '-' . $month;

        if (!strtotime($dateString)) {
            throw new \Exception('"' . $dateString . '" is not a valid strtotime');
        }

        $startDay = new \DateTime($dateString);

        if ($startDay->format('j') > $daysError) {
            $startDay->modify('- 7 days');
        }

        $days = array();

        while ($startDay->format('Y-m') <= $year . '-' . str_pad($month, 2, 0, STR_PAD_LEFT)) {
            $days[] = clone ($startDay);
            $startDay->modify('+ 7 days');
        }

        return $days;
    }
}

if (!function_exists('remove_separator')) {
    function remove_separator($harga)
    {
        return str_replace('.', '', $harga);
    }
}

if (!function_exists('create_separator')) {
    function create_separator($harga)
    {
        return number_format($harga, 0, ',', '.');
    }
}

if (!function_exists('create_character')) {
    function create_character($length)
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('checking_data')) {
    function checking_data($database_name, $table_name, $column_primary, $id)
    {
        $CI = get_instance();

        $get = $CI->db->query("SELECT table_name FROM information_schema.COLUMNS WHERE column_name = '{$column_primary}' AND table_name NOT IN( '{$table_name}') AND table_schema = '{$database_name}'");
        $res = [];
        foreach ($get->result() as $value) {
            $qry = $CI->db->query("SELECT * FROM {$value->table_name} WHERE {$column_primary} = '$id'");
            $num = $qry->num_rows();
            if ($num > 0) {
                $res[] = $value->table_name;
            }
        }
        return count($res);
    }
}

if (!function_exists('compressImage')) {
    function compressImage($source, $destination, $quality)
    {
        // Get image info 
        $imgInfo = getimagesize($source);
        $mime = $imgInfo['mime'];

        // Create a new image from file 
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($source);
                break;
            default:
                $image = imagecreatefromjpeg($source);
        }

        // Save image 
        imagejpeg($image, $destination, $quality);

        // Return compressed image 
        return $destination;
    }
}

if (!function_exists('resizeImage')) {
    function resizeImage($file_name)
    {
        $source          = './' . upload_path('ori_gambar') . $file_name;
        $destination     = './' . upload_path('gambar') . $file_name;
        $compressedImage = compressImage($source, $destination, 15);

        if ($compressedImage) {
            if ($file_name !== null) {
                if (file_exists($source)) {
                    unlink($source);
                }
            }
            
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('add_picture')) {
    function add_picture($request_img)
    {
        $CI = get_instance();
        $config = [
            'upload_path'   => './' . upload_path('ori_gambar'),
            'allowed_types' => 'jpg|jpeg|png',
            'encrypt_name'  => TRUE,
            'overwrite'     => TRUE,
        ];

        $CI->load->library('upload', $config);

        if (!$CI->upload->do_upload($request_img)) {
            // apa bila gagal
            $error = array('error' => $CI->upload->display_errors());

            $result = [
                'status'  => false,
                'message' => strip_tags($error['error']),
            ];
        } else {
            // apa bila berhasil
            $uploadData = $CI->upload->data();
            $uploadFile = $uploadData['file_name'];

            $resizeImage = resizeImage($uploadFile);

            if ($resizeImage) {
                $result = [
                    'status'  => true,
                    'message' => 'Berhasil Upload!',
                    'data'    => $CI->upload->data(),
                ];
            } else {
                $result = [
                    'status'  => false,
                    'message' => 'Gagal Upload!',
                ];
            }
        }
        return $result;
    }
}

if (!function_exists('upd_picture')) {
    function upd_picture($request_img, $picture_name)
    {
        del_picture($picture_name);

        $picture = add_picture($request_img);

        return $picture;
    }
}

if (!function_exists('del_picture')) {
    function del_picture($picture_name)
    {
        $file_gambar = upload_path('gambar') . $picture_name;

        if ($picture_name !== null) {
            if (file_exists($file_gambar)) {
                unlink($file_gambar);
            }
        }
    }
}
