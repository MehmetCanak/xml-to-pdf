<?php 


use Sabre\Xml\Writer;
use Sabre\Xml\XmlDeserializable;

use DateTime;
use InvalidArgumentException;

class PartyName implements XmlDeserializable
{

    private $name = '';

    

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): PartyName
    {
        $this->name = $name;
        return $this;
    }



    public function xmlSerialize(Writer $writer)
    {

       
        $writer->write([
            Schema::CBC . 'Name' => $this->name,
        ]);
        
    }



}




?>