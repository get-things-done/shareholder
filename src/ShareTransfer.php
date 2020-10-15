<?php
namespace GetThingsDone\Shareholder;

use GetThingsDone\Shareholder\Models\Shareholder;
use GetThingsDone\Shareholder\Models\ShareTranferRecord;
use Illuminate\Support\Facades\DB;

class ShareTransfer
{
    protected ShareTranferRecord $record;
    protected Shareholder $fromShareholder;
    protected Shareholder $toShareholder;
    protected int $value = 0;
    
    public function __construct(ShareTranferRecord $record, Shareholder $fromShareholder, Shareholder $toShareholder)
    {
        $this->record = $record;
        $this->fromShareholder = $fromShareholder;
        $this->toShareholder = $toShareholder;
    }

    public function from(Shareholder $fromShareholder): self
    {
        $this->fromShareholder = $fromShareholder;

        return $this;
    }

    public function to(Shareholder $toShareholder): self
    {
        $this->toShareholder = $toShareholder;

        return $this;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function excecute(): ShareTranferRecord
    {
        DB::transaction(function () {
            $fromShareQuantityRecord = app(ShareQuantity::class)
                                        ->of($this->fromShareholder)
                                        ->decrease($this->value);
                                        
            $toShareQuantityRecord = app(ShareQuantity::class)
                                        ->of($this->toShareholder)
                                        ->increase($this->value);

            $this->record = $this->record->create([
                'from_record_id' => $fromShareQuantityRecord->id,
                'to_record_id' => $toShareQuantityRecord->id,
            ]);
        });
        
        return $this->record;
    }

    public function tranfer($value): ShareTranferRecord
    {
        return $this->setValue($value)->excecute();
    }
}
