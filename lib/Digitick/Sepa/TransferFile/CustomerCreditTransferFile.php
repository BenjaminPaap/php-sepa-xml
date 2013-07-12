<?php

namespace Digitick\Sepa\TransferFile;
use Digitick\Sepa\GroupHeader;
use Digitick\Sepa\PaymentInformation;

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

class CustomerCreditTransferFile extends BaseTransferFile {

    const PAIN_FORMAT = 'pain.001.001.03';

    /**
     * @param PaymentInformation $paymentInformation
     */
    public function addPaymentInformation(PaymentInformation $paymentInformation) {
        $paymentInformation->setValidPaymentMethods(array('CHK', 'TRF', 'TRA'));
        // TODO refactor as this will overwrite the payment method
        $paymentInformation->setPaymentMethod('TRF');
        parent::addPaymentInformation($paymentInformation);
    }
}