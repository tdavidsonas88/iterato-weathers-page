<?php


namespace App\Service;

/**
 * Interface for the possibility to add another service for new weather data provider
 *
 * Interface WeatherDataInterface
 * @package App\Service
 */
interface WeatherDataInterface
{
    public function getWeatherData(string $api_key, string $city);
}