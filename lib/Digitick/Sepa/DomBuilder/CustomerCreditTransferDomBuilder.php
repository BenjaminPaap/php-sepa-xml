<?php

namespace Digitick\Sepa\DomBuilder;
use Digitick\Sepa\PaymentInformation;
use Digitick\Sepa\TransferFile\TransferFileInterface;
use Digitick\Sepa\GroupHeader;
use Digitick\Sepa\TransferInformation\TransferInformationInterface;

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

class CustomerCreditTransferDomBuilder extends BaseDomBuilder {

    function __construct() {
        parent::__construct('pain.001.001.05');
    }


    /**
     * Build the root of the document
     *
     * @param TransferFileInterface $transferFile
     * @return mixed
     */
    public function visitTransferFile(TransferFileInterface $transferFile) {
        $this->currentTransfer = $this->doc->createElement('CstmrCdtTrfInitn');
        $this->root->appendChild($this->currentTransfer);
    }

    /**
     * Add GroupHeader Information to the document
     *
     * @param GroupHeader $groupHeader
     * @return mixed
     */
    public function visitGroupHeader(GroupHeader $groupHeader) {
        $groupHeaderTag = $this->doc->createElement('GrpHdr');
        $messageId = $this->createElement('MsgId', $groupHeader->getMessageIdentification());
        $groupHeaderTag->appendChild($messageId);
        $creationDateTime = $this->createElement('CreDtTm', $groupHeader->getCreationDateTime());
        $groupHeaderTag->appendChild($creationDateTime);
        $groupHeaderTag->appendChild($this->createElement('NbOfTxs', $groupHeader->getNumberOfTransactions()));
        $groupHeaderTag->appendChild($this->createElement('CtrlSum', $groupHeader->getControlSumCents()));
        if($groupHeader->getIsTest()) {
            $authstn = $this->createElement('Authstn');
            $authstn->appendChild($this->createElement('Prtry', 'TEST'));
            $groupHeaderTag->appendChild($authstn);
        }
        $initiatingParty = $this->createElement('InitgPty');
        $initiatingPartyName =  $this->createElement('Nm', $groupHeader->getInitiatingPartyName());
        $initiatingParty->appendChild($initiatingPartyName);
        if ($groupHeader->getInitiatingPartyId() !== null) {
            $id = $this->createElement('Id', $groupHeader->getInitiatingPartyId());
            $initiatingParty->appendChild($id);
        }
        $groupHeaderTag->appendChild($initiatingParty);
        $this->currentTransfer->appendChild($groupHeaderTag);
    }

    /**
     * Crawl PaymentInformation containing the Transactions
     *
     * @param PaymentInformation $paymentInformation
     * @return mixed
     */
    public function visitPaymentInformation(PaymentInformation $paymentInformation) {
        // TODO: Implement visitPaymentInformation() method.
    }

    /**
     * Crawl Transactions
     *
     * @param TransferInformationInterface $transactionInformation
     * @return mixed
     */
    public function visitTransferInformation(TransferInformationInterface $transactionInformation) {
        // TODO: Implement visitTransferInformation() method.
    }

}