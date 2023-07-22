<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebController extends Controller
{
    public function index()
    {
        return view('web.roaCheck', [
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
}
