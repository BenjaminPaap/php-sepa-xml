<?php
namespace Tests;

use Digitick\Sepa\GroupHeader;

/**
 * User: s.rohweder@blage.net
 * Date: 7/10/13
 * Time: 11:48 PM
 * License: MIT
 */

class CustomerDirectDebitValidationTest extends \PHPUnit_Framework_TestCase {
    protected $schema;

    /**
     * @var \DOMDocument
     */
    protected $dom;

    protected function setUp() {
        $this->schema = __DIR__ . "/pain.008.002.02.xsd";
        $this->dom = new \DOMDocument('1.0', 'UTF-8');
    }

    /**
     * Sanity check: test reference file with XSD.
     */
    public function testSanity() {
        $this->dom->load(__DIR__ . '/pain.008.002.02.xml');
        $validated = $this->dom->schemaValidate($this->schema);
        $this->assertTrue($validated);
    }

}
