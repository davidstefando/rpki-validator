<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoaCheckRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\Input;
use function PHPUnit\Framework\isNull;

class RoaCheckController extends Controller
{
    public function index(RoaCheckRequest $request)
    {
        $prefix = $request->prefix;
        $originAs = $request->as;

        // first try lookup OriginAS from ROTO API
        $bgpOriginByAPI = $this->getBgpOriginAndBestMatchPrefix($request->prefix);
        if($bgpOriginByAPI != null){
            $prefix = $bgpOriginByAPI["prefix"];
            $originAs = $bgpOriginByAPI["originAS"];
        }

        // if request including OriginAS use it instead
        if($request->has('as') && ($request->input('as') != "")){
            $originAs = $request->as;
        }

        // if none above solved OriginAS
        if($originAs == null){
            $error['as'] = "Can't find BGP Origin AS, please input AS";

            return redirect()->back()
                ->withErrors($error)
                ->withInput($request->input());
        }

        $roaValidation = $this->validateRoute($prefix, $originAs);

        return view('web.roaCheck', [
            'prefix' => $prefix,
            'as' => $originAs,
            'roaValidation' => $roaValidation,
            'APIStatus' => $this->getAPIStatus()
        ]);
    }

    private function getAPIStatus()
    {
        try{
            $statusAPI = Http::get("https://rpki.idnic.net/api/v1/status");
            if($statusAPI->successful()) {
                $response = $statusAPI->object();

                $rpkiLastUpdate =  Carbon::parse($response->lastUpdateDone)->setTimezone("Asia/Jakarta");
                return [
                    'rpkiLastUpdate' => $rpkiLastUpdate->format("Y-m-d H:i:s"),
                    'rpkiLastUpdateFromNow' => $rpkiLastUpdate->diffForHumans()
                ];
            }

            return false;

        } catch (\Exception $exception){
            Log::error($exception->getMessage() . " On Line " . $exception->getFile() . " " . $exception->getLine());
            return false;
        }
    }

    private function getBgpOriginAndBestMatchPrefix($prefix)
    {
        try {
            $bgpAPI = Http::get("https://rest.bgp-api.net/api/v1/prefix/$prefix/search");
            if($bgpAPI->successful()){
                $bgpAPIResponse = $bgpAPI->object();

                // if prefix not found API will return null
                if($bgpAPIResponse == null){
                    return null;
                }

                // if prefix not found in BGP
                if($bgpAPIResponse->result->prefix == null){
                    return null;
                }

                return [
                    "prefix" => $bgpAPIResponse->result->prefix,
                    "originAS" => $bgpAPIResponse->result->meta[0]->originASNs[0] ?? null
                ];
            } else {
                return false;
            }
        } catch (\Exception $exception){
            Log::error($exception->getMessage() . " On Line " . $exception->getFile() . " " . $exception->getLine());
            return false;
        }
    }

    private function validateRoute($prefix, $originAS){
        try {
            $rovAPI = Http::get("https://rpki.idnic.net/api/v1/validity/$originAS/$prefix");
            if($rovAPI->successful()){
                $rovAPIResponse = $rovAPI->object();
                collect($rovAPIResponse->validated_route->validity->VRPs)->each(function (){

                });
                return [
                    'status' => $rovAPIResponse->validated_route->validity->state,
                    'description' => $rovAPIResponse->validated_route->validity->description,
                ];
            } else {
                return false;
            }
        } catch (\Exception $exception){
            Log::error($exception->getMessage() . " On Line " . $exception->getFile() . " " . $exception->getLine());
            return false;
        }
    }
}
