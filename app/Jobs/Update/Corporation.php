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

    protected $corporation_id;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @param int $corporation_id
     * @param Response|null $data
     */
    public function __construct(int $corporation_id, ?Response $data = null)
    {
        $this->corporation_id = $corporation_id;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param Conduit $api
     * @return void
     */
    public function handle(Conduit $api)
    {
        if(is_null($this->data)) {
            $this->data = $api->corporations($this->corporation_id)->get();
        }

        $corporation = CorporationModel::firstOrNew(['id' => $this->corporation_id]);

        $corporation->name = $this->data->name;
        $corporation->ticker = $this->data->ticker;
        $corporation->member_count = $this->data->member_count;
        $corporation->ceo_id = $this->data->ceo_id;
        $corporation->alliance_id = (array_key_exists('alliance_id', $this->data->data) ? $this->data->alliance_id : null);
        $corporation->description = $this->data->description;
        $corporation->tax_rate = $this->data->tax_rate;
        $corporation->date_founded = Carbon::parse($this->data->date_founded);
        $corporation->creator_id = $this->data->creator_id;
        $corporation->url = $this->data->url;
        $corporation->active = false;

        $corporation->save();
    }
}
