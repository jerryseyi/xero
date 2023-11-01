<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Webfox\Xero\OauthCredentialManager;
use XeroAPI\XeroPHP\Api\AccountingApi;
use XeroAPI\XeroPHP\Models\Accounting\Contact;
use XeroAPI\XeroPHP\Models\Accounting\Invoice;
use XeroAPI\XeroPHP\Models\Accounting\Invoices;
use XeroAPI\XeroPHP\Models\Accounting\LineAmountTypes;
use XeroAPI\XeroPHP\Models\Accounting\LineItem;

class DraftInvoiceController extends Controller
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

        // bucket for invoices
        $arr_invoices = [];

        $invoice = new Invoice();
        $invoice->setReference('Ref-' . $this->getRandNum())
            ->setDueDate(new DateTime('2023-12-10'))
            ->setContact($contact)
            ->setLineItems($line_items)
            ->setStatus(Invoice::STATUS_AUTHORISED)
            ->setType(Invoice::TYPE_ACCPAY)
            ->setLineAmountTypes(LineAmountTypes::EXCLUSIVE);

        $arr_invoices[] = $invoice;

        $invoices = new Invoices();
        $invoices->setInvoices($arr_invoices);

        $accountingApi->createInvoices($tenantID, $invoices);
        return redirect()->back();
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
