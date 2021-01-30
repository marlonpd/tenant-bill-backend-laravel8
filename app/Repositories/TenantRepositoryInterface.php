<?php
namespace App\Repositories;

use App\Models\Tenant;
use Illuminate\Support\Collection;

interface TenantRepositoryInterface
{
   public function all(): Collection;
}