<?php
namespace App\MultiTenancy\TenantFinder;

use App\Models\Domain;
use Illuminate\Http\Request;
use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\TenantFinder\TenantFinder;

class CustomDomainTenantFinder extends TenantFinder
{
    public function findForRequest(Request $request): ?Tenant
    {
        $host = $request->getHost();

        $domain = Domain::where('domain', $host)->first();

        if ($domain && $domain->tenant) {
            return $domain->tenant;
        }

        return null;
    }
}
