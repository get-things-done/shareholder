<?php
namespace GetThingsDone\Shareholder;

use Illuminate\Support\Facades\DB;
use GetThingsDone\Shareholder\Models\Shareholder;
use GetThingsDone\Shareholder\Models\ShareTranferRecord;

class ShareTransfer
{
    protected ShareTranferRecord $model;
    protected Shareholder $fromShareholder;
    protected Shareholder $toShareholder;
    protected int $value = 0;
    
    public function __construct(ShareTranferRecord $model,Shareholder $fromShareholder, Shareholder $toShareholder)
    {
        $this->model = $model;
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
        DB::transaction(function(){
            
            $fromShareQuantityRecord = app(ShareQuantity::class)
                                        ->of($this->fromShareholder)
                                        ->decrease( $this->value );
                                        
            $toShareQuantityRecord = app(ShareQuantity::class)
                                        ->of($this->toShareholder)
                                        ->increase( $this->value );

            $this->model = $this->model->create([
                'from_record_id' => $fromShareQuantityRecord->id,
                'to_record_id' => $toShareQuantityRecord->id
            ]);
        });
        
        return $this->model;
    }

    public function tranfer($value): ShareTranferRecord
    {
        return $this->setValue($value)->excecute();
    }
    
}