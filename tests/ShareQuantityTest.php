<?php
namespace GetThingsDone\Shareholder;

use GetThingsDone\Shareholder\Models\Shareholder;
use GetThingsDone\Shareholder\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShareQuantityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function current_should_be_0_when_empty_records()
    {
        $shareholder = Shareholder::factory()->create();
        $quantity = ShareQuantity::of($shareholder)->current();
                        
        $this->assertEquals(0, $quantity);
    }

    /** @test */
    public function current_should_get_when_have_some_records()
    {
        $shareholder = Shareholder::factory()->create();

        ShareQuantity::of($shareholder)->increase(500);
        
        $record = ShareQuantity::of($shareholder)->increase(2000);
        
        $anotherShareholder = Shareholder::factory()->create();
        ShareQuantity::of($anotherShareholder)->increase(1000);

        $this->assertEquals(2500, $record->balance);
        $this->assertEquals(
            2500,
            ShareQuantity::of($shareholder)->current()
        );
    }
}
