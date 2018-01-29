<?php


namespace Asgard\Support;


use Asgard\Models\RedditUser;
use Asgard\Models\Setting;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

/**
 * Class Reddit
 *
 * @package Asgard\Support
 *
 */
class Reddit
{

    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client(
            [
                'base_uri' => 'https://oauth.reddit.com/',
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getAccessToken(),
                    'User-Agent' => 'fiendly-probes-automod/v01 by u/GrimmVenris'
                ]
            ]
        );
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return Cache::remember('reddit_modaccount_access_token', 20, function(){
            $httpClient = new Client();

            $payload = [
                'grant_type' => 'refresh_token',
                'refresh_token' => Setting::get('reddit.modaccount.refresh_token')
            ];

            $response = $httpClient->request('POST', 'https://www.reddit.com/api/v1/access_token',
                [
                    'headers' => ['User-Agent' => 'fiendly-probes-automod/v01 by u/GrimmVenris'],
                    'auth' => [config('services.reddit.client_id'), config('services.reddit.client_secret')],
                    'form_params' => $payload
                ]
            );

            $data = \GuzzleHttp\json_decode($response->getBody()->getContents());

            return $data->access_token;
        });
    }

    public function getSubredditContributors()
    {
        $contributors = collect();
        $after = null;

        do {
            $payload = [];
            if(!is_null($after)){
                $payload = ['query' => ['after' => $after]];
            }

            $response = $this->httpClient->get('r/GrimmsTestReddit/about/contributors', $payload);
            $data = \GuzzleHttp\json_decode($response->getBody()->getContents());

            $after = $data->data->after;

            foreach($data->data->children as $child) {
                $contributors->push($child);
            }

        } while(!is_null($after));


        return $contributors;
    }

    public function addContributor(RedditUser $user)
    {
        $response = $this->httpClient->post('r/GrimmsTestReddit/api/friend',
            [
                'form_params' => [
                    'api_type' => 'json',
                    'action' => 'add',
                    'name' => $user->nickname,
                    'type' => 'contributor',

                ]
            ]
        );
    }

    /**
     * This only takes a name
     * @param $name
     */
    public function removeContributor($name)
    {
        $response = $this->httpClient->post('r/GrimmsTestReddit/api/unfriend',
            [
                'form_params' => [
                    'api_type' => 'json',
                    'name' => $name,
                    'type' => 'contributor',
                ]
            ]
        );
    }
}