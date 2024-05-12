<?php

namespace Tests\Unit;

use App\Models\EloquentCustomer;
use App\Models\EloquentCustomerPointEvent;
use App\Models\PointEvent;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EloquentCustomerPointEventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function register()
    {
        $customerId = 1;
        EloquentCustomer::factory()->create([
            'customer_id' => $customerId,
        ]);

        $event = new PointEvent(
            $customerId,
            '加算イベント',
            100,
            CarbonImmutable::create(2024, 5, 11, 0, 0, 0)
        );
        $sut = new EloquentCustomerPointEvent();
        $sut->register($event);

        $this->assertDatabaseHas('customer_point_events', [
            'customer_id' => $customerId,
            'event' => $event->getEvent(),
            'point' => $event->getPoint(),
            'created_at' => $event->getCreatedAt(),
        ]);
    }
}
