<?php

namespace App\Controller;

use App\Service\WeatherDataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    /**
     * renders form page for data input
     *
     * @Route("/", name="weather")
     */
    public function index()
    {
        return $this->render('weather/index.html.twig', [
            'controller_name' => 'WeatherController',
        ]);
    }

    /**
     * handles AJAX request from twig form
     *
     *
     * @Route("/weather/data", name="weather_data")
     * @param Request $request
     * @param WeatherDataService $weatherDataService
     * @return Response
     */
    public function getWeatherData(Request $request, WeatherDataService $weatherDataService
    )
    {
        $api_key = $request->get('api_key');
        $city = $request->get('city');

        $weatherData = $weatherDataService->getWeatherData($api_key, $city);
        $weatherData = array_merge(['city' => $city], $weatherData);

        return new Response(
            json_encode(
                array('status'=>'success', 'data' => $weatherData)
            )
        );
    }
}
