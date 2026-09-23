<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Railway;
use App\Models\Station;
use App\Models\TimetableStop;

class RailwaySearch extends Component
{

    public $railways;
    public $stations;

    public $railwayId = '';
    public $departureStationId = '';
    public $arrivalStationId = '';
    public $departureTime = '';

    public $results = [];

    public int $limit = 5;

    public function mount(): void
    {

        $this->railways = Railway::all();


        $this->stations = Station::orderBy('station_order')->get();
    }
    public function swapStations(): void
    {
        $temp = $this->departureStationId;

        $this->departureStationId = $this->arrivalStationId;

        $this->arrivalStationId = $temp;
    }
    public function search(): void
    {
        $this->limit = 5;

        $this->performSearch();
    }
    public function loadMore(): void
    {
        $this->limit += 5;

        $this->performSearch();
    }
    private function performSearch(): void
    {
        $this->validate([
            'departureStationId' => ['required'],
            'arrivalStationId' => ['required'],
            'departureTime' => ['required'],
        ]);

        if ($this->departureStationId === $this->arrivalStationId) {
            $this->addError(
                'arrivalStationId',
                '出発駅と到着駅は別の駅を選択してください。'
            );

            return;
        }

        // 出発駅
        $departureStation = Station::findOrFail(
            $this->departureStationId
        );

        // 到着駅
        $arrivalStation = Station::findOrFail(
            $this->arrivalStationId
        );

        // 駅順から上り・下りを判定
        $direction = $departureStation->station_order
            < $arrivalStation->station_order
            ? 'down'
            : 'up';

        // 出発駅を指定時刻以降に発車する列車
        $departureStops = TimetableStop::with('train')
            ->where('station_id', $departureStation->id)
            ->where('departure_time', '>=', $this->departureTime)
            ->whereHas('train', function ($query) use ($direction) {
                $query->where('direction', $direction);
            })
            ->orderBy('departure_time')
            ->take($this->limit)
            ->get();

        $results = [];

        // 同じ列車の到着駅時刻を探す
        foreach ($departureStops as $departureStop) {

            $arrivalStop = TimetableStop::where(
                'train_id',
                $departureStop->train_id
            )
                ->where('station_id', $arrivalStation->id)
                ->first();

            if ($arrivalStop) {
                $results[] = [
                    'train_no' => $departureStop->train->train_no,
                    'departure_time' => $departureStop->departure_time,
                    'arrival_time' => $arrivalStop->arrival_time,
                ];
            }
        }

        $this->results = $results;
    }
    public function render()
    {
        return view('livewire.railway-search');
    }
}
