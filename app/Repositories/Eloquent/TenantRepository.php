<?php
namespace App\Repositories\Eloquent;

use App\Models\Tenant;
use App\Repositories\TenantRepositoryInterface;
use Illuminate\Support\Collection;

class TenantRepository extends BaseRepository implements TenantRepositoryInterface
{

    private $limit = 10;

   /**
    * TenantRepository constructor.
    *
    * @param Tenant $tenant
    */
   public function __construct(Tenant $model)
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
    public function findByOwnerIdLimitedList(int $ownerId, int $pageIndex): Collection
    {
        return $this->model::where('owner_id', $ownerId)
                            ->limit($this->limit)
                            ->offset(($pageIndex-1)  * $this->limit)
                            ->get();
    }

   public function findById(string $id): ?Tenant 
   {
      return $this->model::where('id', $id)->first();   
  }

  public function search(string $ownerId, string $searchKey): ?Collection
  {
    return $this->model::where('owner_id', $ownerId)
                              ->where('name', 'LIKE', "%{$searchKey}%")
                              ->get();   
  }

  public function countSearch(string $ownerId, string $searchKey): ?int
  {
    return $this->model::where('owner_id', $ownerId)
                             ->where('name', 'LIKE', "%{$searchKey}%")
                             ->count();   
  }

  public function findByOwnerId(string $ownerId): ?Collection
  {
    return $this->model::where('owner_id', $ownerId)->get();   
  }

  public function countByOwnerId(string $ownerId): ?int
  {
    return $this->model::where('owner_id', $ownerId)->count();   
  }

  public function update(string $id, array $tenant): int 
  {
    return $this->model::find($id)->update($tenant);   
  }

  public function delete(string $id) 
  {
    return $this->model::where('id', $id)->delete();
  }



}