<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TenantRepositoryInterface;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Http\Requests\DeleteTenantRequest;
use App\Http\Resources\TenantResource;

class TenantController extends Controller
{
    private $tenantRepository;
  
    public function __construct(TenantRepositoryInterface $tenantRepository)
    {
      //  $this->middleware('auth:api', ['except' => ['authenticate']]);
        $this->tenantRepository = $tenantRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'tenants' =>  TenantResource::collection($this->tenantRepository->all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTenantRequest $request)
    {
        $payload = [
            'name' => $request->name,
            'meter_number' => $request->meterNumber,
            'meter_initial_reading'=> $request->meterInitialReading,
        ];

        $tenant = $this->tenantRepository->create($payload);

        if ($tenant) {
            return response()->json([
                'success' => true,
                'tenant' =>  new TenantResource($tenant),
            ]);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'Encountered an error.',
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tenant = $this->tenantRepository->findById($id);

        return $tenant;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTenantRequest $request)
    {
        $id = $request->id;

        $payload = [
            'name' => $request->name,
            'meter_number' => $request->meterNumber,
            'meter_initial_reading'=> $request->meterInitialReading,
        ];

        $tenant = $this->tenantRepository->update($id, $payload);

        if ($tenant) {
            return response()->json([
                'success' => true,
                'tenant' => new TenantResource($tenant),
            ]);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'Encountered an error.',
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteTenantRequest $request)
    {
        $tenant = $this->tenantRepository->delete($request->id);
 
        if ($tenant) {
            return response()->json([
                'success' => true,
                'tenant' =>  $tenant,
            ]);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'Encountered an error.',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}