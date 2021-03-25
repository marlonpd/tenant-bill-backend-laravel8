<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MeterReadingRepositoryInterface;
use App\Repositories\TenantRepositoryInterface;
use App\Http\Resources\MeterReadingResource;
use App\Http\Requests\UpdateMeterReadingRequest;
use App\Http\Requests\StoreMeterReadingRequest;
use Symfony\Component\HttpFoundation\Response;

class MeterReadingController extends Controller
{
    private $meterReadingRepository;
    private $tenantRepository;
  
    public function __construct(MeterReadingRepositoryInterface $meterReadingRepository, TenantRepositoryInterface $tenantRepository)
    {
      //  $this->middleware('auth:api', ['except' => ['authenticate']]);
        $this->meterReadingRepository = $meterReadingRepository;
        $this->tenantRepository = $tenantRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tenantId)
    {
        if (!is_numeric($tenantId)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid tenant id',
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'meterReadings' =>  MeterReadingResource::collection($this->meterReadingRepository->finyByTenantId($tenantId)),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLimitedList(int $tenantId, int $pageIndex)
    {
        $meterReadingsCount = $this->meterReadingRepository->countByTenantId($tenantId);

        return response()->json([
            'meterReadings' =>  MeterReadingResource::collection($this->meterReadingRepository->findByTenantIdLimitedList($tenantId, $pageIndex)),
            'count' => $meterReadingsCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeterReadingRequest $request)
    {
        $tenantId = $request->tenantId;
        $tenant = $this->tenantRepository->find($tenantId);

        if (empty($tenant)) {
            return response()->json([
                'success' => false,
                'message' => 'Tenant not found!',
            ], Response::HTTP_BAD_REQUEST);
        }
        
        //$powerRate = $this->powerRateRepository->findByTenantId($tenantId);

        $payload = [
            'tenant_id' => $tenantId,
            'from_date' =>  date("Y-m-d H:i:s", strtotime($request->fromDate)),
            'present_reading_kwh' =>  $request->presentReadingKwh,
            'to_date' =>  date("Y-m-d H:i:s", strtotime($request->toDate)),
            'previous_reading_kwh' =>  $request->previousReadingKwh,
            'consumed_kwh' =>  $request->consumedKwh,
            'rate' =>  $request->rate,
            'bill' =>  $request->bill
        ];

        $meterReading = $this->meterReadingRepository->create($payload);
        
        return response()->json([
            'success' => true,
            'meterReading' => new MeterReadingResource($meterReading),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(UpdateMeterReadingRequest $request)
    {
        $id = $request->id;
        $tenantId = $request->tenantId;
        $tenant = $this->tenantRepository->find($tenantId);

        if (empty($tenant)) {
            return response()->json([
                'success' => false,
                'message' => 'Tenant not found!',
            ], Response::HTTP_BAD_REQUEST);
        }

        $payload = [
            'tenant_id' => $tenantId,
            'from_date' =>  date("Y-m-d H:i:s", strtotime($request->fromDate)),
            'present_reading_kwh' =>  $request->presentReadingKwh,
            'to_date' =>  date("Y-m-d H:i:s", strtotime($request->toDate)),
            'previous_reading_kwh' =>  $request->previousReadingKwh,
            'consumed_kwh' =>  $request->consumedKwh,
            'rate' =>  $request->rate,
            'bill' =>  $request->bill
        ];

        $meterReading = $this->meterReadingRepository->update($id, $payload);

        if ($meterReading) {
            return response()->json([
                'success' => true,
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
    public function destroy(DeleteMeterReadingRequest $request)
    {
        $meterReading = $this->meterReadingRepository->delete($request->id);
 
        if ($meterReading) {
            return response()->json([
                'success' => true,
                'meterReading' => new MeterReadingResource($meterReading),
            ]);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'Encountered an error.',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}