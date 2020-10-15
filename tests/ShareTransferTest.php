<?php
namespace GetThingsDone\Shareholder\Tests;

use GetThingsDone\Shareholder\Models\Shareholder;
use GetThingsDone\Shareholder\ShareQuantity;
use GetThingsDone\Shareholder\ShareTransfer;

class ShareTransferTest extends TestCase
{
    /** @test */
    public function it_can_transfer_from_shareholder_to_anothor_shareholder()
    {
        $shareholder = Shareholder::factory()->create();
        $anotherShareholder = Shareholder::factory()->create();
        
        $record = app(ShareTransfer::class)
            ->from($shareholder)
            ->to($anotherShareholder)
            ->tranfer(1000);
            
        $this->assertEquals(
            app(ShareQuantity::class)->of($shareholder)->current(),
            -1000
        );
        
        $this->assertEquals(
            app(ShareQuantity::class)->of($anotherShareholder)->current(),
            1000
        );
    }
}
