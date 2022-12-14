<?php



use Sabre\Xml\Writer;
use Sabre\Xml\XmlDeserializable;

class DocumentReference implements XmlDeserializable
{
    private $id;
    private $issueDate;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return DespatchDocumentReference
     */
    public function setId(string $id): DespatchDocumentReference
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getIssueDate(): string
    {
        return $this->issueDate;
    }

    /**
     * @param string $issueDate
     * @return DocumentReference
     */

    public function setIssueDate(string $issueDate): DocumentReference
    {
        $this->issueDate = $issueDate;
        return $this;
    }
    public function validate()
    {
        if ($this->id === null) {
            throw new \Exception('DocumentReference ID is required');
        }
        if ($this->issueDate === null) {
            throw new \Exception('DocumentReference IssueDate is required');
        }
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
        if($this->issueDate !== null){
            $writer->write([ Schema::CBC . 'IssueDate' => $this->issueDate ]);
        }
        
    }
}
