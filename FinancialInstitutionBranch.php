<?php



use Sabre\Xml\Writer;
use Sabre\Xml\XmlDeserializable;

class FinancialInstitutionBranch implements XmlDeserializable
{
    private $id;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return FinancialInstitutionBranch
     */
    public function setId(?string $id): FinancialInstitutionBranch
    {
        $this->id = $id;
        return $this;
    }

    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            Schema::CBC . 'ID' => $this->id
        ]);
    }
}
