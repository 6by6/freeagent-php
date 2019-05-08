<?php

namespace SixBySix\Freeagent\Tests\Entity;

use SixBySix\Freeagent\Entity\Company;
use SixBySix\Freeagent\Tests\TestCase;

class CompanyTest extends AbstractEntityTest
{

    public function getClassName()
    {
        return 'SixBySix\Freeagent\Entity\Company';
    }

    public function getApiMethodName()
    {
        return 'company';
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
                ],
                [
                    'getUrl' => 'https://api.freeagent.com/v2/company',
                    'getName' => 'Demo Ltd',
                    'getSubdomain' => 'demoltd',
                    'getType' => 'UkLimitedCompany',
                    'getCurrency' => 'GBP',
                    'getMileageUnits' => 'miles',
                    'getCompanyStartDate' => \DateTime::createFromFormat('Y-m-d', '2014-05-01'),
                    'getFreeagentStartDate' => \DateTime::createFromFormat('Y-m-d', '2015-05-01'),
                    'getFirstAccountingYearEnd' => \DateTime::createFromFormat('Y-m-d', '2015-04-30'),
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
                    'getSalesTaxEffectiveDate' => \DateTime::createFromFormat('Y-m-d', '2014-05-01'),
                    'getSalesTaxRates' => [20.0, 5.0, 0],
                    'getSalesTaxIsValueAdded' => true,
                    'getSupportsAutoSalesTaxOnPurchases' => true,
                    'getVatFirstReturnPeriodEndsOn' => \DateTime::createFromFormat('Y-m-d', '2014-09-01'),
                    'getInitialVatBasis' => 'Cash',
                    'getInitiallyOnFrs' => true,
                    'getInitialVatFrsType' => 'Computer and IT consultancy or data processing',
                ]
            ]
        ];
    }

    /**
     * @test
     */
    public function getOne()
    {
        /** @var AbstractEntity $first */
        $first = $this->entity->query()->getFirst();

        if (!$first) {
            $this->fail(
                sprintf('No instances of %s found, cannot test', get_class($this->entity))
            );
        }

        /** @var AbstractEntity $entity */
        $entity = $this->entity->getByUrl($first->getUrl());

        $this->assertInstanceOf($this->getClassName(), $entity);
    }
}
