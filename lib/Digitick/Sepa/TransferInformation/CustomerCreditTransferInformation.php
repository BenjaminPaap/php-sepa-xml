<?php

namespace Digitick\Sepa\TransferInformation;

/**
 * SEPA file generator.
 *
 * @copyright © Blage <www.blage.net> 2013
 * @license GNU Lesser General Public License v3.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Lesser Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

class CustomerCreditTransferInformation extends BaseTransferInformation {

    /**
     * Must be between 0.01 and 999999999.99
     *
     * @var string
     */
    protected $amount;

    /**
     * @var string
     */
    protected $instructionId;

    /**
     * @var string
     */
    protected $EndToEndIdentification;

    /**
     * Account Identifier
     *
     * @var string
     */
    protected $iban;

    /**
     * Financial Institution Identifier;
     *
     * @var string
     */
    protected $bic;

    /**
     * @var string
     */
    protected $creditorName;

    /**
     * @var string
     */
    protected $creditorCountry;

    /**
     * @var string
     */
    protected $creditorStreet;

    /**
     * @var string
     */
    protected $creditorZipCity;

    /**
     * Purpose of this transaction
     *
     * @var string
     */
    protected $remittanceInformation;

    /**
     * @param string $amount
     * @param string $iban
     * @param string $creditorName
     */
    function __construct($amount, $iban, $creditorName) {
        $this->amount = (float)$amount * 100;
        $this->iban = $iban;
        $this->creditorName = $creditorName;
        // FIXME broken implementation find suitable IDs
        $this->instructionId = $creditorName;
        $this->EndToEndIdentification = $creditorName;
    }


    /**
     * @param string $EndToEndIdentification
     */
    public function setEndToEndIdentification($EndToEndIdentification) {
        $this->EndToEndIdentification = $EndToEndIdentification;
    }

    /**
     * @return string
     */
    public function getEndToEndIdentification() {
        return $this->EndToEndIdentification;
    }

    /**
     * @param string $amount
     */
    public function setAmount($amount) {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @param string $bic
     */
    public function setBic($bic) {
        $this->bic = $bic;
    }

    /**
     * @return string
     */
    public function getBic() {
        return $this->bic;
    }

    /**
     * @param string $creditorCountry
     */
    public function setCreditorCountry($creditorCountry) {
        $this->creditorCountry = $creditorCountry;
    }

    /**
     * @return string
     */
    public function getCreditorCountry() {
        return $this->creditorCountry;
    }

    /**
     * @param string $creditorName
     */
    public function setCreditorName($creditorName) {
        $this->creditorName = $creditorName;
    }

    /**
     * @return string
     */
    public function getCreditorName() {
        return $this->creditorName;
    }

    /**
     * @param string $creditorStreet
     */
    public function setCreditorStreet($creditorStreet) {
        $this->creditorStreet = $creditorStreet;
    }

    /**
     * @return string
     */
    public function getCreditorStreet() {
        return $this->creditorStreet;
    }

    /**
     * @param string $creditorZipCity
     */
    public function setCreditorZipCity($creditorZipCity) {
        $this->creditorZipCity = $creditorZipCity;
    }

    /**
     * @return string
     */
    public function getCreditorZipCity() {
        return $this->creditorZipCity;
    }

    /**
     * @param string $iban
     */
    public function setIban($iban) {
        $this->iban = $iban;
    }

    /**
     * @return string
     */
    public function getIban() {
        return $this->iban;
    }

    /**
     * @param string $instructionId
     */
    public function setInstructionId($instructionId) {
        $this->instructionId = $instructionId;
    }

    /**
     * @return string
     */
    public function getInstructionId() {
        return $this->instructionId;
    }

    /**
     * @param mixed $paymentId
     */
    public function setPaymentId($paymentId) {
        $this->paymentId = $paymentId;
    }

    /**
     * @return mixed
     */
    public function getPaymentId() {
        return $this->paymentId;
    }

    /**
     * @param string $remittanceInformation
     */
    public function setRemittanceInformation($remittanceInformation) {
        $this->remittanceInformation = $remittanceInformation;
    }

    /**
     * @return string
     */
    public function getRemittanceInformation() {
        return $this->remittanceInformation;
    }



}