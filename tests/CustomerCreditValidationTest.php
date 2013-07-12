<?php

namespace Tests;

use Digitick\Sepa\CustomerCredit;
use Digitick\Sepa\DomBuilder\CustomerCreditTransferDomBuilder;
use Digitick\Sepa\GroupHeader;
use Digitick\Sepa\PaymentInformation;
use Digitick\Sepa\TransferFile\CustomerCreditTransferFile;
use Digitick\Sepa\TransferInformation\CustomerCreditTransferInformation;

/**
 * Various schema validation tests.
 */
class CustomerCreditValidationTest extends \PHPUnit_Framework_TestCase
{
	protected $schema;

    /**
     * @var \DOMDocument
     */
    protected $dom;
	
	protected function setUp()
	{
		$this->schema = __DIR__ . "/pain.001.001.05.xsd";
		$this->dom = new \DOMDocument('1.0', 'UTF-8');
	} 

	/**
	 * Sanity check: test reference file with XSD.
	 */
	public function testSanity()
	{
		$this->dom->load(__DIR__ . '/pain.001.001.05.xml');
		$validated = $this->dom->schemaValidate($this->schema);
		$this->assertTrue($validated);
	}

	/**
	 * Test a transfer file with one payment and one transaction.
	 */
	public function testSinglePaymentSingleTrans()
	{

        $domBuilder = new CustomerCreditTransferDomBuilder();

        $groupHeader = new GroupHeader('transferID', 'Me');
        $sepaFile = new CustomerCreditTransferFile($groupHeader);

        $transfer = new CustomerCreditTransferInformation('0.02', 'FI1350001540000056', 'Their Corp');
        $transfer->setBic('OKOYFIHH');
        $transfer->setRemittanceInformation('Transaction Description');

        $payment = new PaymentInformation('Payment Info ID', 'FR1420041010050500013M02606', 'PSSTFRPPMON', 'My Corp');
		$payment->addTransfer($transfer);

        $sepaFile->addPaymentInformation($payment);

        $sepaFile->accept($domBuilder);

		$this->dom->loadXML($domBuilder->asXml());
		
		$validated = $this->dom->schemaValidate($this->schema);
		$this->assertTrue($validated);
	}

	/**
	 * Test a transfer file with one payment and several transactions.
	 */
	public function testSinglePaymentMultiTrans()
	{
        $groupHeader = new GroupHeader('transferID', 'Me');
        $sepaFile = new CustomerCredit($groupHeader);
		
		$payment = $sepaFile->addPaymentInfo(array(
			'id'                    => 'Payment Info ID',
			'debtorName'            => 'My Corp',
			'debtorAccountIBAN'     => 'FR1420041010050500013M02606',
			'debtorAgentBIC'        => 'PSSTFRPPMON'
		));
		$payment->addCreditTransfer(array(
			'id'                    => 'Id shown in bank statement',
			'currency'              => 'EUR',
			'amount'                => '0.02',
			'creditorName'          => 'Their Corp',
			'creditorAccountIBAN'   => 'FI1350001540000056',
			'creditorBIC'           => 'OKOYFIHH',
			'remittanceInformation' => 'Transaction description',
		));
		$payment->addCreditTransfer(array(
			'id'                    => 'Id shown in bank statement',
			'currency'              => 'EUR',
			'amount'                => '5000.00',
			'creditorName'          => 'GHI Semiconductors',
			'creditorAccountIBAN'   => 'BE30001216371411',
			'creditorBIC'           => 'DDDDBEBB',
			'remittanceInformation' => 'Transaction description',
		));
		
		$this->dom->loadXML($sepaFile->asXML());
		
		$validated = $this->dom->schemaValidate($this->schema);
		$this->assertTrue($validated);
	}
	
	/**
	 * Test a transfer file with several payments, one transaction each.
	 */
	public function testMultiPaymentSingleTrans()
	{
        $groupHeader = new GroupHeader('transferID', 'Me');
        $sepaFile = new CustomerCredit($groupHeader);
		
		$payment1 = $sepaFile->addPaymentInfo(array(
			'id'                    => 'Payment Info ID',
			'debtorName'            => 'My Corp',
			'debtorAccountIBAN'     => 'FR1420041010050500013M02606',
			'debtorAgentBIC'        => 'PSSTFRPPMON'
		));
		$payment1->addCreditTransfer(array(
			'id'                    => 'Id shown in bank statement',
			'currency'              => 'EUR',
			'amount'                => '0.02',
			'creditorName'          => 'Their Corp',
			'creditorAccountIBAN'   => 'FI1350001540000056',
			'creditorBIC'           => 'OKOYFIHH',
			'remittanceInformation' => 'Transaction description',
		));
		$payment2 = $sepaFile->addPaymentInfo(array(
			'id'                    => 'Payment Info ID',
			'debtorName'            => 'My Corp',
			'debtorAccountIBAN'     => 'FR1420041010050500013M02606',
			'debtorAgentBIC'        => 'PSSTFRPPMON'
		));
		$payment2->addCreditTransfer(array(
			'id'                    => 'Id shown in bank statement',
			'currency'              => 'EUR',
			'amount'                => '5000.00',
			'creditorName'          => 'GHI Semiconductors',
			'creditorAccountIBAN'   => 'BE30001216371411',
			'creditorBIC'           => 'DDDDBEBB',
			'remittanceInformation' => 'Transaction description',
		));
		
		$this->dom->loadXML($sepaFile->asXML());
		
		$validated = $this->dom->schemaValidate($this->schema);
		$this->assertTrue($validated);
	}
	
	/**
	 * Test a transfer file with several payments, several transactions each.
	 */
	public function testMultiPaymentMultiTrans()
	{
        $groupHeader = new GroupHeader('transferID', 'Me');
        $sepaFile = new CustomerCredit($groupHeader);
		
		$payment1 = $sepaFile->addPaymentInfo(array(
			'id'                    => 'Payment Info ID',
			'debtorName'            => 'My Corp',
			'debtorAccountIBAN'     => 'FR1420041010050500013M02606',
			'debtorAgentBIC'        => 'PSSTFRPPMON'
		));
		$payment1->addCreditTransfer(array(
			'id'                    => 'Id shown in bank statement',
			'currency'              => 'EUR',
			'amount'                => '0.02',
			'creditorName'          => 'Their Corp',
			'creditorAccountIBAN'   => 'FI1350001540000056',
			'creditorBIC'           => 'OKOYFIHH',
			'remittanceInformation' => 'Transaction description',
		));
		$payment1->addCreditTransfer(array(
			'id'                    => 'Id shown in bank statement',
			'currency'              => 'EUR',
			'amount'                => '5000.00',
			'creditorName'          => 'GHI Semiconductors',
			'creditorAccountIBAN'   => 'BE30001216371411',
			'creditorBIC'           => 'DDDDBEBB',
			'remittanceInformation' => 'Transaction description',
		));
		
		$payment2 = $sepaFile->addPaymentInfo(array(
			'id'                    => 'Payment Info ID',
			'debtorName'            => 'My Corp',
			'debtorAccountIBAN'     => 'FR1420041010050500013M02606',
			'debtorAgentBIC'        => 'PSSTFRPPMON'
		));
		$payment2->addCreditTransfer(array(
			'id'                    => 'Id shown in bank statement',
			'currency'              => 'EUR',
			'amount'                => '0.02',
			'creditorName'          => 'Their Corp',
			'creditorAccountIBAN'   => 'FI1350001540000056',
			'creditorBIC'           => 'OKOYFIHH',
			'remittanceInformation' => 'Transaction description',
		));
		$payment2->addCreditTransfer(array(
			'id'                    => 'Id shown in bank statement',
			'currency'              => 'EUR',
			'amount'                => '5000.00',
			'creditorName'          => 'GHI Semiconductors',
			'creditorAccountIBAN'   => 'BE30001216371411',
			'creditorBIC'           => 'DDDDBEBB',
			'remittanceInformation' => 'Transaction description',
		));
		
		$this->dom->loadXML($sepaFile->asXML());
		
		$validated = $this->dom->schemaValidate($this->schema);
		$this->assertTrue($validated);
	}
}
