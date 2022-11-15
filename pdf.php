<?php
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

use Barryvdh\DomPDF\Facade\Pdf as PdfCreate;
use Dompdf\Dompdf;

class pdf
{

    public function responseHtml(string $uuid,array $xml, bool $isShow)
    {
        if(!isset($xml['path']) || !isset($xml['fileName'])){
            echo 'XML dosyası kaydedilemedi.';
            die;
        } 
        if($xml['path'] == null ||  $xml['fileName'] == null) {
            custom_abort_('XML dosyası kaydedilemedi.');
            die;
        }
        $path = $xml['path'];
        $xmlFileName = $xml['fileName'];
        $htmlFileName = $uuid.'.html';
        $pdfFileName = $uuid.'.pdf';
        $xsltPath = __DIR__.'\general.xslt';
        $htmlPath = __DIR__.'\\'. $uuid.'.html';
        $pdfPath = __DIR__.'\\'. $uuid.'.pdf';

        
        error_reporting(0);
        $xsl = new \DomDocument();
        $xsl->load($xsltPath);
        $inputdom = new \DomDocument();
        $inputdom->load(__DIR__ .'/'.$xmlFileName);
        $proc = new \XsltProcessor();

        $xsl = $proc->importStylesheet($xsl);
        if(! $xsl) 
        {
            echo "xsl yuklenemedi";
            die;
        }
        // $proc->setParameter(null, "titles", "Titles");
        $newdom = $proc->transformToDoc($inputdom);
        $saveHtml = $this->saveHtml($htmlPath, $htmlFileName, $newdom->saveXML());
        if($saveHtml) {
            return true;
        }else {
            return false;
        }
    }
    public function responsePdf(string $uuid,array $xml, $isHow)
    {
        if(!isset($xml['path']) || !isset($xml['fileName'])){
            echo 'XML dosyası kaydedilemedi.';
            die;
        } 
        if($xml['path'] == null ||  $xml['fileName'] == null) {
            custom_abort_('XML dosyası kaydedilemedi.');
            die;
        }
        $path = $xml['path'];
        $xmlFileName = $xml['fileName'];
        $htmlFileName = $uuid.'.html';
        $pdfFileName = $uuid.'.pdf';
        $xsltPath = __DIR__.'\general.xslt';
        $htmlPath = __DIR__.'\\'. $uuid.'.html';
        $pdfPath = __DIR__.'\\'. $uuid.'.pdf';


        error_reporting(0);
        $xsl = new \DomDocument();
        $xsl->load($xsltPath);
        $inputdom = new \DomDocument();
        $inputdom->load(__DIR__ .'/'.$xmlFileName);
        $proc = new \XsltProcessor();
        $xsl = $proc->importStylesheet($xsl);
        if(! $xsl) 
        {
            echo "xsl yuklenemedi";
            die;
        }
        // $proc->setParameter(null, "titles", "Titles");
        $newdom = $proc->transformToDoc($inputdom);
        $saveHtml = $this->saveHtml($htmlPath, $htmlFileName, $newdom->saveXML());

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($newdom->saveXML(),'UTF-8');

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

        // $pdf = PdfCreate::loadHTML( $newdom->saveXML(),'UTF-8')->setPaper('a4', 'portrait')->setWarnings(false)->save($pdfFileName);
        //  $pdf = Pdf::loadHTML( $newdom->saveXML(),'UTF-8')->setPaper('a4', 'landscape')->setWarnings(false)->save($pdfFileName);
        if($saveHtml) {
            return true;
        }else {
            return false;
        }

    }
    
    public function saveHtml($path, $fileName, $html)
    {
        try{
            $dom = new \DOMDocument("1.0", "utf-8");
            $dom->loadXML($html);
            $dom->encoding = "utf-8";
            $dom->save($path);
        }catch (\Exception $e){
            echo 'HTML dosyası kaydedilemedi.';
            die;
        }
        return true;
    }
    

}

$path = __DIR__ . '\21bf950e-1cf4-4402-8f38-a7820331ceba.xml';
$fileName = '21bf950e-1cf4-4402-8f38-a7820331ceba.xml';

$xml = [
    'path' => $path,
    'fileName' => $fileName,
];
$uuid = '21bf950e-1cf4-4402-8f38-a7820331ceba';

$new = new pdf();
$response = $new->responsePdf($uuid,$xml,false);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>HTML</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    
    <div class="jumbotron d-flex align-items-center">


        <div class="container">

        <a href="/xslt" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Anasayfa</a>  
            <h1><?php if($response) echo "Pdf kaydedildi"; else echo "PDF KAYDEDİKLMEDİ"; ?></h1>

        <!-- Content here -->
        </div>
    </div>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>





