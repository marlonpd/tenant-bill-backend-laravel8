<?php
namespace App\Repositories\Eloquent;

use App\Models\MeterReading;
use App\Repositories\MeterReadingRepositoryInterface;
use Illuminate\Support\Collection;

class MeterReadingRepository extends BaseRepository implements MeterReadingRepositoryInterface
{
    private $limit = 10;
    /**
    * MeterReadingRepository constructor.
    *
    * @param MeterReading $model
    */
    public function __construct(MeterReading $model)
    {
      parent::__construct($model);
    }

    /**
    * @return Collection
    */
    public function all(): Collection
    {
      return $this->model->all();    
    }

    /**
    * @return Collection
    */
    public function findByTenantIdLimitedList(int $tenantId, int $pageIndex): Collection
    {
      return $this->model::where('tenant_id', $tenantId)
                            ->limit($this->limit)
                            ->offset(($pageIndex-1)  * $this->limit)
                            ->get();
    }

    public function countByTenantId(int $tenantId): ?int
    {
      return $this->model::where('tenant_id', $tenantId)->count();
    }

    public function findById(string $id): ?MeterReading 
    {
      return $this->model::where('id', $id)->first();   
    }

    public function update(string $id, array $meterReading): int 
    {
      return $this->model::where('id', $id)->update($meterReading);   
    }

    public function finyByTenantId(int $tenantId): Collection 
    {
      return $this->model::where('tenant_id', $tenantId)->get();   
    }

    public function delete(string $id) {
      return $this->model::where('id', $id)->delete();
    }
}