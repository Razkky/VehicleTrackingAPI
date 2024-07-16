<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateVehicleLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-vehicle-location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info("Cron Job running at ". now());
        $vehicles = Vehicle::where('tracking_status', true)->get();
        foreach ($vehicles as $vehicle) {
            $vehicle->locations()->create([
                'latitude' => $this->generateRandomLatitude(),
                'longitude' => $this->generateRandomLongitude(),
            ]);
        }
    }

    private function generateRandomLongitude() {
        return mt_rand(-90000000, 90000000) / 10000;
    }
}
