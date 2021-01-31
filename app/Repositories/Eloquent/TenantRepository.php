<?php
namespace App\Repositories\Eloquent;

use App\Models\Tenant;
use App\Repositories\TenantRepositoryInterface;
use Illuminate\Support\Collection;

class TenantRepository extends BaseRepository implements TenantRepositoryInterface
{

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

   public function findById(string $id): ?Tenant 
   {
      $tenant = $this->model::where('id', $id)->first();   

      return $tenant;
  }

  public function update(string $id, Tenant $tenant): ?Tenant 
  {
     $tenant = $this->model::where('id', $id)->update($tenant);   

     return $tenant;
  }



}