<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Webfox\Xero\OauthCredentialManager;
use XeroAPI\XeroPHP\Api\AccountingApi;
use XeroAPI\XeroPHP\Models\Accounting\Contact;
use XeroAPI\XeroPHP\Models\Accounting\Invoice;
use XeroAPI\XeroPHP\Models\Accounting\LineItem;
use XeroAPI\XeroPHP\Models\Accounting\RepeatingInvoice;
use XeroAPI\XeroPHP\Models\Accounting\RepeatingInvoices;
use XeroAPI\XeroPHP\Models\Accounting\Schedule;

class RecurringInvoiceController extends Controller
{
    public function index()
    {

    }

    public function store(AccountingApi $accountingApi, OauthCredentialManager $credentialManager, Request $request)
    {
        $tenantID = $credentialManager->getTenantId();
        $line_items = [];
        $line_items[] = $this->getLineItem();

        $contact = new Contact();
        $contact->setContactId($request->contactID);

        $schedule = new Schedule();
        $schedule->setPeriod(2) //Integer used with the unit e.g. 1 (every 1 week), 2 (every 2 months)
                ->setUnit("WEEKLY") //can be WEEKLY
                ->setDueDate(5) //integer dependent on DueDateType
                ->setDueDateType("DAYSAFTERBILLDATE")  //e.g. DAYSAFTERBILLDATE, DAYSAFTERBILLMONTH, OFCURRENTMONTH,OFFOLLOWINGMONTH
                ->setNextScheduledDate(new DateTime('2023-11-02'));
        //->setEndDate(); //optional

        $repeatInvoice = new RepeatingInvoice();
        $repeatInvoice->setType(Invoice::TYPE_ACCREC)
            ->setSchedule($schedule)
            ->setContact($contact)
            ->setLineItems($line_items)
            ->setLineAmountTypes("Inclusive")
            ->setReference("RP4789")
            ->setCurrencyCode("NGN")
            ->setStatus("DRAFT")
            ->setApprovedForSending(false); //boolean - can be true only if Status is AUTHORISED

        $repeatInvoices = new RepeatingInvoices();
        $arr_repeat_invoices = [];
        $arr_repeat_invoices[] = $repeatInvoice;
        $repeatInvoices->setRepeatingInvoices($arr_repeat_invoices);

        $accountingApi->createRepeatingInvoices($tenantID, $repeatInvoices, true);
    }
    public function getLineItem()
    {
        $lineItem = new LineItem();
        $lineItem->setDescription('Sample Item' . $this->getRandNum())
            ->setQuantity(1)
            ->setUnitAmount(20)
            ->setAccountCode("400");

        return $lineItem;
    }

    public function getRandNum()
    {
        $randNum = strval(rand(1000,100000));

        return $randNum;
    }
}
