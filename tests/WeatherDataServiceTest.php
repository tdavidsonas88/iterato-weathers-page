<?php

namespace App\Tests;

use App\Service\OpenWeatherDataService;
use PHPUnit\Framework\TestCase;

class WeatherDataServiceTest extends TestCase
{
    public function testGetWeatherData()
    {
        $weatherDataService = new OpenWeatherDataService();
        $weatherData = $weatherDataService->getWeatherData('09f19c9b654002cbf141f941bfef65ac', 'Vilnius');
        $this->assertIsArray($weatherData);
    }
}
