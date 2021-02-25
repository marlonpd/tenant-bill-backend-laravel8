<?php
namespace App\Repositories;

use App\Models\PowerRate;
use Illuminate\Support\Collection;

interface PowerRateRepositoryInterface
{
   public function all(): Collection;
}