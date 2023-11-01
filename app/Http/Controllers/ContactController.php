<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Webfox\Xero\OauthCredentialManager;
use XeroAPI\XeroPHP\Api\AccountingApi;
use XeroAPI\XeroPHP\ApiException;
use XeroAPI\XeroPHP\Models\Accounting\Address;
use XeroAPI\XeroPHP\Models\Accounting\Contact;
use XeroAPI\XeroPHP\Models\Accounting\Contacts;
use XeroAPI\XeroPHP\Models\Accounting\Phone;

class ContactController extends Controller
{
    public function index(AccountingApi $accountingApi, OauthCredentialManager $credentialManager)
    {
        $tenantID = $credentialManager->getTenantId();
        $contacts = $accountingApi->getContacts($tenantID);
        return Inertia::render('Contacts/Index', compact('contacts'));
    }

    public function create()
    {
        return Inertia::render('Contacts/Create');
    }

    /**
     * @throws ApiException
     */
    public function store(Request $request, AccountingApi $accountingApi, OauthCredentialManager $credentialManager)
    {
        $tenantID = $credentialManager->getTenantId();

        // Bucket to hold contacts.
        $arr_contacts = [];

        // Bucket to hold addresses
        $addresses = [];

        // Bucket to hold phones.
        $phones = [];

        // set address
        $address = new Address();
        $address
            ->setAddressType(Address::ADDRESS_TYPE_STREET)
            ->setAddressLine1($request->addresses);
        $addresses[] = $address;

        // set phone
        $phone = new Phone();
        $phone
            ->setPhoneType(Phone::PHONE_TYPE__DEFAULT)
            ->setPhoneNumber($request->phones);
        $phones[] = $phone;

        $contact = new Contact();
        $contact->setName($request->name)
                ->setFirstName($request->firstName)
                ->setLastName($request->lastName)
                ->setAddresses($addresses)
                ->setEmailAddress($request->emailAddresses)
                ->setPhones($phones);
        $arr_contacts[] = $contact;

        $contacts = new Contacts();
        $contacts->setContacts($arr_contacts);

        $accountingApi->createContacts($tenantID, $contacts);
        return redirect()->route('contact.index');
    }
}
