<?php



use Sabre\Xml\Writer;
use Sabre\Xml\XmlDeserializable;
use InvalidArgumentException;

class Person implements XmlDeserializable
{
    private $firstName;
    private $familyName;
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): Person
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setFamilyName(?string $familyName): Person
    {
        $this->familyName = $familyName;
        return $this;
    }
    public function validate()
    {
        if($this->getFirstName() === null) {
            throw new InvalidArgumentException('firstName is required');
        }
        if($this->getFamilyName() === null) {
            throw new InvalidArgumentException('familyName is required');
        }
    }

    public function xmlSerialize(Writer $writer)
    {

        $this->validate();

        $writer->write([
            Schema::CBC . 'FirstName' => $this->getFirstName(),
            Schema::CBC . 'FamilyName' => $this->getFamilyName(),
        ]);
    }


}
