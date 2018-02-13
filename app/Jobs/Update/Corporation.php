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
        $corporation->ceo_id = (array_key_exists('ceo_id', $this->data->data) ? $this->data->ceo_id : null);
        $corporation->alliance_id = (array_key_exists('alliance_id', $this->data->data) ? $this->data->alliance_id : null);
        $corporation->description = (array_key_exists('description', $this->data->data) ? $this->data->description : null);
        $corporation->tax_rate = (array_key_exists('tax_rate', $this->data->data) ? $this->data->tax_rate : null);
        $corporation->date_founded = (array_key_exists('date_founded', $this->data->data) ? Carbon::parse($this->data->date_founded) : null);
        $corporation->creator_id = (array_key_exists('creator_id', $this->data->data) ? $this->data->creator_id : null);
        $corporation->url = (array_key_exists('url', $this->data->data) ? $this->data->url : null);
        $corporation->active = false;

        $corporation->save();
    }
}
