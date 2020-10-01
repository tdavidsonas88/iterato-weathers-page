<?php


namespace App\Service\Factory;


use App\Service\MeteoService;
use App\Service\OpenWeatherService;

class WeatherServiceFactory
{
    public function make($provider = null)
    {
        switch ($provider) {
            case 'open_weather':
                return new OpenWeatherService();
            case 'meteo':
                return new MeteoService();
                break;

        }
    }

}