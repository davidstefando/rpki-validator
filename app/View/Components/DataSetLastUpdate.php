<?php

namespace App\View\Components;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class DataSetLastUpdate extends Component
{
    public $APIStatus;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->APIStatus = $this->getAPIStatus();
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

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.data-set-last-update');
    }
}
