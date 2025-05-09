<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * CodeIgniter Dompdf Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @packge     CodeIgniter
 * @subpackage Libraries
 * @category   Libraries
 * @author     Alan Saputra Lengkoan
 * @license    MIT License
 */

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends Dompdf
{
    public function __construct()
    {
        parent::__construct();
    }

    // untuk cetak pdf
    public function cetakPdf($file_name, $view, $data = [])
    {
        $CI = get_instance();

        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $this->setOptions($options);
        
        $html = $CI->load->view($view, $data, TRUE);
        $this->loadHtml($html);
        $this->render();
        ob_end_clean();
        $this->stream($file_name . '.pdf', ['Attachment' => false]);
    }
}
