<?php

namespace SixBySix\Freeagent\Tests\Entity;

use SixBySix\Freeagent\Entity\Company;
use SixBySix\Freeagent\Tests\TestCase;

class CompanyTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->api->connect();
    }

    /**
     * @test
     */
    public function getAccountCompany()
    {
        /** @var Company $company */
        $company = $this->api->getCompany();

        $this->assertInstanceOf('SixBySix\Freeagent\Entity\Company', $company);
    }

    /**
     * @test
     * @dataProvider deserializeProvider
     * @param $json
     * @param $accessors
     */
    public function deserialize($json, $accessors)
    {
        /** @var Company $company */
        $company = $this->api->company();

        $company = $company->deserialize($json, get_class($company));

        $this->assertInstanceOf('SixBySix\Freeagent\Entity\Company', $company);

        foreach ($accessors as $methodName => $value) {
            $this->assertEquals($value, $company->$methodName());
        }
    }

    public function deserializeProvider()
    {
        return [
            [
                [
                    'url' => 'https://api.freeagent.com/v2/company',
                    'name' => 'Demo Ltd',
                    'subdomain' => 'demoltd',
                    'type' => 'UkLimitedCompany',
                    'currency' => 'GBP',
                    'mileage_units' => 'miles',
                    'company_start_date' => '2014-05-01',
                    'freeagent_start_date' => '2015-05-01',
                    'first_accounting_year_end' => '2015-04-30',
                    'company_registration_number' => 'ABC1234',
                    'sales_tax_registration_status' => 'Registered',
                    'address1' => '3/4',
                    'address2' => '33 Oswald Street',
                    'address3' => 'Broomielaw',
                    'town' => 'Glasgow',
                    'postcode' => 'G1 4PG',
                    'country' => 'United Kingdom',
                    'contact_email' => 'daniel@sixbysix.co.uk',
                    'contact_phone' => '+44 (0141) 413 4020',
                    'website' => 'www.sixbysix.co.uk',
                    'business_type' => 'Software services',
                    'short_date_format' => 'dd mm yy',
                    'ec_vat_reporting_enabled' => true,
                    'sales_tax_name' => 'VAT',
                    'sales_tax_registration_number' => 'ABC123 55',
                    'sales_tax_effective_date' => '2014-05-01',
                    'sales_tax_rates' => [20.0, 5.0, 0],
                    'sales_tax_is_value_added' => true,
                    'supports_auto_sales_tax_on_purchases' => true,
                    'vat_first_return_period_ends_on' => '2014-09-01',
                    'initial_vat_basis' => 'Cash',
                    'initially_on_frs' => true,
                    'initial_vat_frs_type' => 'Computer and IT consultancy or data processing',
                    'locked_attributes' => ['currency'],
                    'created_at' => '2014-05-06T12:27:18.000Z',
                    'updated_at' => '2016-03-07T08:27:41.000Z',
                ],
                [
                    'getUrl' => 'https://api.freeagent.com/v2/company',
                    'getName' => 'Demo Ltd',
                    'getSubdomain' => 'demoltd',
                    'getType' => 'UkLimitedCompany',
                    'getCurrency' => 'GBP',
                    'getMileageUnits' => 'miles',
                    'getCompanyStartDate' => '2014-05-01',
                    'getFreeagentStartDate' => '2015-05-01',
                    'getFirstAccountingYearEnd' => '2015-04-30',
                    'getCompanyRegistrationNumber' => 'ABC1234',
                    'getSalesTaxRegistrationStatus' => 'Registered',
                    'getAddress1' => '3/4',
                    'getAddress2' => '33 Oswald Street',
                    'getAddress3' => 'Broomielaw',
                    'getTown' => 'Glasgow',
                    'getPostcode' => 'G1 4PG',
                    'getCountry' => 'United Kingdom',
                    'getContactEmail' => 'daniel@sixbysix.co.uk',
                    'getContactPhone' => '+44 (0141) 413 4020',
                    'getWebsite' => 'www.sixbysix.co.uk',
                    'getBusinessType' => 'Software services',
                    'getShortDateFormat' => 'dd mm yy',
                    'getEcVatReportingEnabled' => true,
                    'getSalesTaxName' => 'VAT',
                    'getSalesTaxRegistrationNumber' => 'ABC123 55',
                    'getSalesTaxEffectiveDate' => '2014-05-01',
                    'getSalesTaxRates' => [20.0, 5.0, 0],
                    'getSalesTaxIsValueAdded' => true,
                    'getSupportsAutoSalesTaxOnPurchases' => true,
                    'getVatFirstReturnPeriodEndsOn' => '2014-09-01',
                    'getInitialVatBasis' => 'Cash',
                    'getInitiallyOnFrs' => true,
                    'getInitialVatFrsType' => 'Computer and IT consultancy or data processing',
                    'getLockedAttributes' => ['currency'],
                    'getCreatedAt' => \DateTime::createFromFormat('Y-m-d\TH:i:s.000Z', '2014-05-06T12:27:18.000Z'),
                    'getUpdatedAt' => \DateTime::createFromFormat('Y-m-d\TH:i:s.000Z', '2016-03-07T08:27:41.000Z'),
                ]
            ]
        ];
    }
}