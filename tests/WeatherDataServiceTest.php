<?php

namespace App\Tests;

use App\Service\WeatherDataService;
use PHPUnit\Framework\TestCase;

class WeatherDataServiceTest extends TestCase
{
    public function testSomething()
    {
        $weatherDataService = new WeatherDataService();
        $weatherData = $weatherDataService->getWeatherData('09f19c9b654002cbf141f941bfef65ac', 'Vilnius');
        $this->assertIsArray($weatherData);
    }
}
