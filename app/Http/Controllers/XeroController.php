<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Webfox\Xero\OauthCredentialManager;
use XeroAPI\XeroPHP\Api\AccountingApi;

class XeroController extends Controller
{
    public function index(Request $request, OauthCredentialManager $credentialManager)
    {
        try {
            if ($credentialManager->exists()) {
                $xero = resolve(AccountingApi::class);
                $organizationName = $xero->getOrganisations($credentialManager->getTenantId())->getOrganisations()[0]->getName();
                $user = $credentialManager->getUser();
                $username = "{$user['given_name']} {$user['family_name']} ({$user['username']})";
            }
        } catch (\Throwable $exception) {
            $error = $exception->getMessage();
        }

        return Inertia::render('Welcome', [
            'connected' => $credentialManager->exists(),
            'error' => $error ?? null,
            'organizationName' => $organizationName ?? null,
            'username' => $username ?? null
        ]);
    }
}
