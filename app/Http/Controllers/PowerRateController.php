<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\PowerRateRepositoryInterface;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PowerRateResource;
use App\Http\Requests\StorePowerRateRequest;

class PowerRateController extends Controller
{
    private $powerRateRepository;

    public function __construct(PowerRateRepositoryInterface $powerRateRepository)
    {
        $this->powerRateRepository = $powerRateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ownerId = auth()->user()->id;

        return response()->json([
            'powerRates' =>  PowerRateResource::collection($this->powerRateRepository->findByOwnerId($ownerId)),
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
    public function store(Request $request)
    {
        $user = auth()->user();
        $payload = [
            'owner_id' => $user->id,
            'rate' => $request->rate,
        ];
        $newPowerRate = $this->powerRateRepository->create($payload);

        return response()->json([
            'success' => true,
            'powerRate' => new PowerRateResource($newPowerRate),
            'message' => 'Invalid owner id',
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}