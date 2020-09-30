<?php


namespace App\Service;


use GuzzleHttp\Client;

class WeatherDataService
{
    public function getWeatherData(string $api_key, string $city)
    {
        $client = new Client([
            'base_uri' => 'https://api.meteo.lt/v1/places/'.$city.'/forecasts/long-term',
            'timeout' => 5.0,
        ]);
        $response = $client->request('GET');
        return json_decode($response->getBody()->getContents(), true);
    }
}