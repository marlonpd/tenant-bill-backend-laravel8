<?php
namespace App\Repositories\Eloquent;

use App\Models\PowerRate;
use App\Repositories\PowerRateRepositoryInterface;
use Illuminate\Support\Collection;

class PowerRateRepository extends BaseRepository implements PowerRateRepositoryInterface
{

   /**
    * PowerRateRepository constructor.
    *
    * @param PowerRate $model
    */
  public function __construct(PowerRate $model)
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

  public function findById(string $id): ?PowerRate 
  {
    return $this->model::where('id', $id)->first(); 
  }
  
  public function findByOwnerId(int $ownerId): ?Collection
  {
    return $this->model::where('owner_id', $ownerId)->get();   
  }

  public function findCurrentRateByOwner(int $ownerId): ?PowerRate
  {
    return $this->model::where('owner_id', $ownerId)->latest()->first();
  }

  public function delete(int $id) 
  {
    return $this->model::where('id', $id)->delete();
  }
}