<?php



use Sabre\Xml\Writer;
use Sabre\Xml\XmlDeserializable;

class ContractDocumentReference implements XmlDeserializable
{
    private $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return ContractDocumentReference
     */
    public function setId(string $id): ContractDocumentReference
    {
        $this->id = $id;
        return $this;
    }

    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer)
    {
        if ($this->id !== null) {
            $writer->write([ Schema::CBC . 'ID' => $this->id ]);
        }
    }
}
