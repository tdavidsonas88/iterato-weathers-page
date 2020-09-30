<?php


namespace App\Service;


interface WeatherDataInterface
{
    public function getWeatherData(string $api_key, string $city);
}