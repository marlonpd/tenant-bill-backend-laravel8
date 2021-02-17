<?php
namespace App\Repositories;

use App\Models\MeterReading;
use Illuminate\Support\Collection;

interface MeterReadingRepositoryInterface
{
   public function all(): Collection;
}