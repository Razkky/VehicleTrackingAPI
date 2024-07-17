<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\VehicleTracker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleTrackerTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void {
            parent::setUp();

            $apiKey = config('services.api_key');

            $this->withHeaders([
                'X-API-Key' => $apiKey
            ]);
    }

    public function test_get_vehicles_returns_all_vehicles() {
        $vehicle1 = VehicleTracker::factory()->create([
            'manufacturer' => 'Toyota',
            'model' => 'Corolla',
            'year' => '2020',
            'tracking_status' => 'true'
        ]);

        $vehicle2 = VehicleTracker::factory()->create([
            'manufacturer' => 'Honda',
            'model' => 'Civic',
            'year' => '2019',
            'tracking_status' => 'false'
        ]);

        $response = $this->getJson('/api/v1/vehicles');

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'code' => 200,
                    'message' => '',
                    'data' => [
                        [
                            'id' => $vehicle1->id,
                            'manufacturer' => 'Toyota',
                            'model' => 'Corolla',
                            'year' => '2020',
                            'trackingStatus' => false
                        ],
                        [
                            'id' => $vehicle2->id,
                            'manufacturer' => 'Honda',
                            'model' => 'Civic',
                            'year' => '2019',
                            'trackingStatus' => false
                        ]
                    ],
                    'error' => ''
                ]);
    }

    public function test_update_vehicle_status_fails_if_vehicle_not_found() {
        $response = $this->json('POST', '/api/v1/vehicle/999/update_status', [
            'trackingStatus' => true
        ]);

        $response->assertStatus(404)
                ->assertJson([
                    'status' => 'error',
                    'code' => 404,
                    'data' => [],
                    'error' => 'No Vehicle with such id found'
                ]);
    }

    public function test_update_vehicle_status_successfully_updates_vehicle() {
        $vehicle = VehicleTracker::factory()->create([
            'manufacturer' => 'Mercedez Benz',
            'model' => 'HighLander',
            'year' => '2016',
            'tracking_status' => false
        ]);

        $response = $this->json('POST', "/api/v1/vehicle/{$vehicle->id}/update_status", [
            'trackingStatus' => true
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'code' => 200,
                    'data' => [
                        'manufacturer' => 'Mercedez Benz',
                        'model' => 'HighLander',
                        'year' => '2016',
                        'trackingStatus' => true
                    ],
                    'error' => ''
                ]);

        $vehicle = $vehicle->fresh();
        $this->assertEquals(true, $vehicle->tracking_status);
    }

    public function test_start_tracking_fails_if_vehicle_not_found() {
            // Test for no vehicle found
            $response = $this->json('POST', '/api/v1/vehicle/999/start_tracking');

            $response->assertStatus(404)
                    ->assertJson([
                        'status' => 'error',
                        'code' => 404,
                        'error' => 'No Vehicle with such id found'
                    ]);
        }

    public function test_start_tracking_successfully_starts_tracking() {
        $vehicle = VehicleTracker::factory()->create([
            'tracking_status' => false
        ]);

        $response = $this->json('POST', "/api/v1/vehicle/{$vehicle->id}/start_tracking");

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Tracking Started Successfully'
                ]);

        $vehicle = $vehicle->fresh();
        $this->assertTrue($vehicle->tracking_status == 1 ? true : false);
    }

    public function test_stop_tracking_fails_if_vehicle_not_found() {
            $response = $this->json('POST', '/api/v1/vehicle/999/stop_tracking');

            $response->assertStatus(404)
                    ->assertJson([
                        'status' => 'error',
                        'code' => 404,
                        'error' => 'No Vehicle with such id found'
                    ]);
    }

    public function test_stop_tracking_successfully_stop_tracking() {
        $vehicle = VehicleTracker::factory()->create([
            'tracking_status' => true
        ]);

        $response = $this->json('POST', "/api/v1/vehicle/{$vehicle->id}/stop_tracking");

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Tracking Stopped Successfully'
                ]);

        $vehicle = $vehicle->fresh();
        $this->assertFalse($vehicle->tracking_status == 1 ? true : false);
    }
}
