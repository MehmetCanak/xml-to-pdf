<?php
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

include 'vendor/autoload.php';

use Sabre\Xml\Service;

class Parse
{

    public function parseXml($path, $fileName)
    {
        error_reporting(0);
        $inputdom = new \DomDocument();
        $inputdom->load(__DIR__ .'/'.$fileName);
        // var_dump($inputdom);
        $xml = simplexml_load_file($path);
        $xml = $inputdom->saveXML();

 
        $xmlService = new Service();

        $xmlService->namespaceMap = [
            'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2' => '',
            'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2' => 'cbc',
            'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2' => 'cac',
            'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2' => 'ext',
            'http://www.altova.com/samplexml/other-namespace' => 'n4',
            'http://www.w3.org/2001/XMLSchema-instance' => 'xsi',
        ];
        

        // $f = fopen("file.txt", "w");
        // fwrite($f, print_r($service->parse($xml), true));
        // fclose($f);

        $reader = new Sabre\Xml\Reader();
        $reader->xml($xml);
        $result = $reader->parse();
        $f3 = fopen("file3.txt", "w");
        fwrite($f3, print_r($result, true));
        fclose($f3);
        echo "done";
        die;
    }
}

$path = __DIR__ . '\21bf950e-1cf4-4402-8f38-a7820331ceba.xml';
$fileName = '21bf950e-1cf4-4402-8f38-a7820331ceba.xml';


$new = new Parse();
$response = $new->parseXml($path, $fileName);
die;

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





