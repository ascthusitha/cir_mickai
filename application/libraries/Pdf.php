<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
require_once dirname(__FILE__) . '/mpdf/mpdf.php';

class Pdf extends mPDF
{
    function __construct()
    {
        parent::__construct();
    }
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */