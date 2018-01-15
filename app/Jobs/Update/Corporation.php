<?php

namespace Asgard\Jobs\Update;

use Carbon\Carbon;
use Conduit\Conduit;
use Conduit\Response;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Asgard\Models\Corporation as CorporationModel;

class Corporation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $corporation;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CorporationModel $corporation, ?Response $data = null)
    {
        $this->corporation = $corporation;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Conduit $api)
    {

        if(is_null($this->data)) {
            $this->data = $api->corporations($this->corporation->id)->get();
        }

        $this->corporation->name = $this->data->name;
        $this->corporation->ticker = $this->data->ticker;
        $this->corporation->member_count = $this->data->member_count;
        $this->corporation->ceo_id = $this->data->ceo_id;
        $this->corporation->alliance_id = (array_key_exists('alliance_id', $this->data->data) ? $this->data->alliance_id : null);
        $this->corporation->description = $this->data->description;
        $this->corporation->tax_rate = $this->data->tax_rate;
        $this->corporation->date_founded = Carbon::parse($this->data->date_founded);
        $this->corporation->creator_id = $this->data->creator_id;
        $this->corporation->url = $this->data->url;

        $this->corporation->save();

    }
}
