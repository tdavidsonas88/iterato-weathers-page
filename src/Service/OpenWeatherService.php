<?php


namespace App\Service;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OpenWeatherService implements WeatherDataInterface
{

    /**
     * gets the data from external provider
     *
     * @param string $city
     * @param string $api_key
     * @return mixed|null
     * @throws GuzzleException
     */
    public function getWeatherData(string $city, string $api_key)
    {
        $client = new Client([
            'base_uri' => 'api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=' . $api_key . '&units=metric',
            'timeout' => 5.0,
        ]);
        $response = $client->request('GET');
        return $this->getImportantWeatherData(json_decode($response->getBody()->getContents(), true));
    }

    private function getImportantWeatherData($cityForecast)
    {
        $conditionCode = $cityForecast['weather'][0]['main'];
        $tempCelcius = $cityForecast['main']['temp'];
        $windSpeed = $cityForecast['wind']['speed'];
        return [
            'conditionCode' => $conditionCode,
            'airTemperature' => $tempCelcius,
            'windSpeed' => $windSpeed

        ];
    }
}