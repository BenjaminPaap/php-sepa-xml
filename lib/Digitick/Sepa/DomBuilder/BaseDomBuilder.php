<?php

namespace Digitick\Sepa\DomBuilder;

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

abstract class BaseDomBuilder implements DomBuilderInterface {

    const INITIAL_STRING = '<?xml version="1.0" encoding="UTF-8"?><Document xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="urn:iso:std:iso:20022:tech:xsd:%s"></Document>';

    protected $doc;

    protected $root;

    protected $currentTransfer = null;

    protected $currentPayment = null;

    function __construct($painFormat) {
        $this->doc = new \DOMDocument('1.0', 'UTF-8');
        $this->doc->formatOutput = true;
        $this->root = $this->doc->createElement('Document');
        $this->root->setAttribute('xmlns', sprintf("urn:iso:std:iso:20022:tech:xsd:%s", $painFormat));
        $this->root->setAttribute('xmlns:xsi',"http://www.w3.org/2001/XMLSchema-instance");
        $this->doc->appendChild($this->root);
    }

    /**
     * @param $name
     * @param null $value
     * @return \DOMElement
     */
    protected function createElement($name, $value = null) {
        if($value){
            return $this->doc->createElement($name, $value);
        } else {
            return $this->doc->createElement($name);
        }
    }

    /**
     * @return string
     */
    public function asXml(){
        return $this->doc->saveXML();
    }

    /**
     * Format an integer as a monetary value.
     */
    protected function intToCurrency($amount)
    {
        return sprintf("%01.2f", ($amount / 100));
    }
}