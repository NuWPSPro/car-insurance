<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter PDF Library
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			Muhanz
 * @license			MIT License
 * @link			https://github.com/hanzzame/ci3-pdf-generator-library
 *
 */

// require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');
require_once(dirname(__FILE__) . '/dompdf/dompdf_config.inc.php');
// use Dompdf\Dompdf;

class Pdf
{
	public function create($html,$filename,$preview = true)
    {
	    $dompdf = new Dompdf();
		$dompdf->load_html($html);
	    // $dompdf->loadHtml($html);
	    $dompdf->render();
		if($preview == true){
			$dompdf->stream($filename.'.pdf');
		}else{
			$dompdf->stream($filename.'.pdf',array('Attachment'=>0)); die;
		}


  }
}