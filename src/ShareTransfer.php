<?php
namespace GetThingsDone\Shareholder;

use GetThingsDone\Shareholder\Models\Shareholder;
use GetThingsDone\Shareholder\Models\ShareTranferRecord;
use Illuminate\Support\Facades\DB;

class ShareTransfer
{
    protected Shareholder $from;
    protected Shareholder $to;
    protected int $quantity = 0;
    
    public function __construct(Shareholder $from, Shareholder $to, int $quantity = 0)
    {
        $this->from = $from;
        $this->to = $to;
        $this->quantity = 0;
    }

    public function from(Shareholder $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function to(Shareholder $to): self
    {
        $this->to = $to;

        return $this;
    }

    public function quantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
    
    public function transfer(): ShareTranferRecord
    {
        DB::beginTransaction();

        try {
            $fromRecord = ShareQuantity::of($this->from)
                            ->decrease($this->quantity);
                                        
            $toRecord = ShareQuantity::of($this->to)
                            ->increase($this->quantity);

            $record = ShareTranferRecord::create([
                'from_record_id' => $fromRecord->id,
                'to_record_id' => $toRecord->id,
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }

        return $record;
    }
}
