<?php
namespace GetThingsDone\Shareholder;

use GetThingsDone\Shareholder\Models\SharePriceRecord;
use GetThingsDone\Shareholder\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SharePriceTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function current_price_equal_0_when_have_no_record()
    {
        $this->assertEquals(
            app(SharePrice::class)->current(),
            0
        );
    }

    /** @test */
    public function current_price_is_last_record_value()
    {
        SharePriceRecord::factory()->count(100)->create();

        SharePriceRecord::create(['value' => 1000 ]);

        $this->assertEquals(
            app(SharePrice::class)->current(),
            1000
        );
    }

    /** @test */
    public function it_can_update_price_when_have_no_record()
    {
        app(SharePrice::class)->update(1000);
        
        $this->assertDatabaseHas('share_price_records', [
            'id' => 1,
            'value' => 1000,
        ]);
    }

    /** @test */
    public function it_can_update_price_when_have_some_record()
    {
        SharePriceRecord::factory()->count(100)->create();
        app(SharePrice::class)->update(1000);

        $this->assertEquals(
            app(SharePrice::class)->current(),
            1000
        );
    }
}
