<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Railway;
use App\Models\Station;
use App\Models\Train;
use App\Models\TimetableStop;

class RailwaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/railway_timetable.csv');

        $file = fopen($path,'r');

        $header = fgetcsv($file);

        $railway = Railway::create([
            'name' => '架空鉄道',
        ]);

        $stationNames = array_slice($header,2);

        $stations = [];

        foreach($stationNames as $index => $stationName){
            $stations[] = Station::create([
                'railway_id' => $railway->id,
                'name' => $stationName,
                'station_order' => $index + 1,
            ]);
        }

        while(($row =fgetcsv($file)) !== false){

            $train = Train::create([
                'railway_id' => $railway->id,
                'train_no' => $row[0],
                'direction' => $row[1],
            ]);

            $times = array_slice($row,2);

            foreach($times as $index => $time) {
                TimetableStop::create([
                    'train_id' => $train->id,
                    'station_id' => $stations[$index]->id,
                    'arrival_time' => $time,
                    'departure_time' => $time,
                    'stop_order' => $index + 1,
                ]);
            }

        }

        fclose($file);
    }
}
