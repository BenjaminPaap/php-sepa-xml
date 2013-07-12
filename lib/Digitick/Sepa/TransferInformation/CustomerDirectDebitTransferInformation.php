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

class CustomerDirectDebitTransferInformation extends BaseTransferInformation {


    /**
     * @var string
     */
    protected $sequenceType;

    /**
     * @var \DateTime
     */
    protected $mandateSignDate;

    /**
     * @var \DateTime
     */
    protected $finalCollectionDate;

    /**
     * @param string $sequenceType
     */
    public function setSequenceType($sequenceType) {
        $this->sequenceType = $sequenceType;
    }

    /**
     * @return string
     */
    public function getSequenceType() {
        return $this->sequenceType;
    }

}