<?php


namespace App\Service\Factory;


use App\Service\OpenWeatherDataService;

class WeatherServiceFactory
{
    public function make($provider = null)
    {
        switch ($provider) {
            case 'open_weather':
                return new OpenWeatherDataService();
        }
    }

}