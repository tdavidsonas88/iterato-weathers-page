<?php

namespace App\Tests;

use App\Service\MeteoService;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class MeteoServiceTest extends TestCase
{
    /**
     * @throws GuzzleException
     */
    public function testGetWeatherData()
    {
        $weatherDataService = new MeteoService();
        $weatherData = $weatherDataService->getWeatherData('Vilnius');
        $this->assertIsArray($weatherData);
    }
}
