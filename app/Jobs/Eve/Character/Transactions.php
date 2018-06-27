<?php

namespace Asgard\Jobs\Eve\Character;

use Asgard\Models\Character;
use Asgard\Support\ConduitAuthTrait;
use Carbon\Carbon;
use Conduit\Conduit;
use Conduit\Exceptions\HttpStatusException;


class Transactions extends CharacterUpdateJob
{
    use ConduitAuthTrait;

    /**
     * Execute the job.
     *
     * @param Conduit $api
     * @return void
     */
    public function handle(Conduit $api)
    {
        $api->setAuthentication($this->getAuthentication($this->character));
        $result = $api->characters($this->character->id)->wallet()->transactions()->get();

        $transactions = collect($result->data)->recursive()->keyBy('transaction_id');
        $transactionIds = $transactions->keys();

        $knownTransactions = $this->character->transactions()
            ->whereIn('transaction_id', $transactionIds->toArray())->get()->keyBy('transaction_id');
        $transactionIds = $transactionIds->diff($knownTransactions->keys());

        if ($transactionIds->isEmpty()) {
            return;
        }

        $transactions = $transactions->whereIn('transaction_id', $transactionIds);

        $clients = $transactions->pluck('client_id');

        $resolvedClients = collect();
        $clients->unique()->values()->chunk(500)->each(function ($chunk) use ($api, &$resolvedClients) {
            $response = $api->universe()->names()->data($chunk->toArray())->post();
            $clients = collect($response->data)->recursive()->keyBy('id');

            $resolvedClients = $resolvedClients->merge($clients);
        });

        $resolvedClients = $resolvedClients->values()->keyBy('id');

        $resolvedLocations = collect();
        $transactions->pluck('location_id')->unique()->values()->each(function ($location) use ($api, $resolvedLocations) {
            // structures
            if ($location > 1000000000000) {
                try {
                    $response = $api->universe()->structures($location)->get();
                    $resolvedLocations->push(collect($response->data));

                } catch (HttpStatusException $exception) {
                    if ($exception->getCode() == '403') {
                        $resolvedLocations->push(collect(['name' => 'No access to structure', 'structure_id' => $location]));
                    } else if ($exception->getCode() == '404') {
                        $resolvedLocations->push(collect(['name' => 'Structre not found', 'structure_id' => $location]));
                    } else {
                        throw $exception;
                    }
                }

            } //stations
            else {
                $response = $api->universe()->stations($location)->get();
                $resolvedLocations->push(collect($response->data));
            }
        });

        $resolvedLocations = $resolvedLocations->values()->keyBy(function ($item) {
            if ($item->has('structure_id')) return $item['structure_id'];
            return $item['station_id'];
        });

        $newTransactions = collect();
        $transactions->each(function ($transaction) use ($resolvedClients, $resolvedLocations, $newTransactions) {
            $locationType = $transaction->get('location_id') > 1000000000000 ? "structure" : "station";
            $locationName = $resolvedLocations->has($transaction->get('location_id')) ? $resolvedLocations->get($transaction->get('location_id'))->get('name') : null;
            $clientName = $resolvedClients->has($transaction->get('client_id')) ? $resolvedClients->get($transaction->get('client_id'))->get('name') : null;
            $clientType = $resolvedClients->has($transaction->get('client_id')) ? $resolvedClients->get($transaction->get('client_id'))->get('category') : null;

            $newTransactions->push([
                'transaction_id' => $transaction->get('transaction_id'),
                'client_id' => $transaction->get('client_id'),
                'client_name' => $clientName,
                'client_type' => $clientType,
                'is_buy' => $transaction->get('is_buy'),
                'is_personal' => $transaction->get('is_personal'),
                'journal_ref_id' => $transaction->get('journal_ref_id'),
                'location_id' => $transaction->get('location_id'),
                'location_type' => $locationType,
                'location_name' => $locationName,
                'quantity' => $transaction->get('quantity'),
                'type_id' => $transaction->get('type_id'),
                'unit_price' => $transaction->get('unit_price'),
                'date' => Carbon::parse($transaction->get('date')),
            ]);
        });

        $this->character->transactions()->createMany($newTransactions->toArray());
    }
}
