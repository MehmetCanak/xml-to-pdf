<?php



use Sabre\Xml\Writer;
use Sabre\Xml\XmlDeserializable;

use DateTime;
use InvalidArgumentException;

class SignatoryParty implements XmlDeserializable
{

    private $partyIdentification;
    private $postalAddress;

    /**
     * @return string
     */ 
    public function getPostalAddress(): ?Address
    {
        return $this->postalAddress;
    }

    /**
     * @param string $postalAddress
     * @return SignatoryParty
     */
    public function setPostalAddress(?Address $postalAddress): SignatoryParty
    {
        $this->postalAddress = $postalAddress;
        return $this;
    }   


    /**
     * @return PartyIdentification
     */
    public function getPartyIdentification(): ?PartyIdentification
    {
        return $this->partyIdentification;
    }

    /**
     * @param PartyIdentification $partyIdentification
     * @return SignatoryParty
     */
    public function setPartyIdentification(?PartyIdentification $partyIdentification): SignatoryParty
    {
        $this->partyIdentification = $partyIdentification;
        return $this;
    }

    /**
     * @return PartyName
     */
    public function getPartyName(): ?PartyName
    {
        return $this->partyName;
    }

    /**
     * @param PartyName $partyName
     * @return SignatoryParty
     */
    public function setPartyName(?PartyName $partyName): SignatoryParty
    {
        $this->partyName = $partyName;
        return $this;
    }

    /**
     * @return DigitalSignatureAttachment
     */
    public function getDigitalSignatureAttachment(): ?DigitalSignatureAttachment
    {
        return $this->digitalSignatureAttachment;
    }

    /**
     * @param DigitalSignatureAttachment $digitalSignatureAttachment
     * @return SignatoryParty
     */
    public function setDigitalSignatureAttachment(?DigitalSignatureAttachment $digitalSignatureAttachment): SignatoryParty
    {
        $this->digitalSignatureAttachment = $digitalSignatureAttachment;
        return $this;
    }

    public function validate()
    {
        if ($this->partyIdentification === null) {
            throw new InvalidArgumentException('VKN veya TCKN numaras?? bo?? olamaz');
        }
        if ($this->postalAddress === null) {
            throw new InvalidArgumentException('Adres bilgisi bo?? olamaz');
        }

    }

    public function xmlSerialize(Writer $writer)
    {
        $this->validate();

        $writer->write([
            Schema::CAC . 'PartyIdentification' =>  $this->partyIdentification,
            Schema::CAC . 'PostalAddress' =>  $this->postalAddress,
        ]);


    }

}
