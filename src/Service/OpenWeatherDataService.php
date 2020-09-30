<?php


namespace App\Service;


use DateTime;
use DateTimeZone;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OpenWeatherDataService implements WeatherDataInterface
{
    /**
     * gets the data from external provider
     *
     * @param string $api_key
     * @param string $city
     * @return mixed|null
     * @throws GuzzleException
     * @throws Exception
     */
    public function getWeatherData(string $api_key, string $city)
    {
        $client = new Client([
            'base_uri' => 'https://api.meteo.lt/v1/places/'.$city.'/forecasts/long-term',
            'timeout' => 5.0,
        ]);
        $response = $client->request('GET');
        return $this->getCurrentWeatherData(json_decode($response->getBody()->getContents(), true));
    }

    /**
     * gets the forcast data related to the current hour from the list of provider timestamps
     *
     * @param $cityForecast
     * @return mixed|null
     * @throws Exception
     */
    private function getCurrentWeatherData($cityForecast)
    {
        $date = new DateTime('now', new DateTimeZone('Europe/Vilnius'));
        $vilniusCurrentTimeHourly = $date->format('Y-m-d H') . ":00:00";

        $currentWeatherTimestamp = null;
        foreach ($cityForecast['forecastTimestamps'] as $timestamp) {
            if ($timestamp['forecastTimeUtc'] == $vilniusCurrentTimeHourly) {
                $currentWeatherTimestamp = $timestamp;
                break;
            }
        }
        return $currentWeatherTimestamp;
    }
}