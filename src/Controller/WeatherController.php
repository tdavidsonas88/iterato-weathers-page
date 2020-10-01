<?php

namespace App\Controller;

use App\Service\Factory\WeatherServiceFactory;
use App\Service\WeatherDataInterface;
use GuzzleHttp\Exception\GuzzleException;
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
     * @param WeatherServiceFactory $weatherServiceFactory
     * @return Response
     */
    public function getWeatherData(Request $request, WeatherServiceFactory $weatherServiceFactory
    )
    {
        $api_key = $request->get('api_key');
        $city = $request->get('city');


        try {
            /** @var WeatherDataInterface $weatherDataService */
            $weatherDataService = $weatherServiceFactory->make('open_weather');
            $weatherData = $weatherDataService->getWeatherData($city, $api_key);
        } catch (GuzzleException $e) {
            return new Response(
                json_encode(
                    array('status'=>'failure', 'data' => "please, correct the form data")
                )
            );
        }
        $weatherData = array_merge(['city' => $city], $weatherData);

        return new Response(
            json_encode(
                array('status'=>'success', 'data' => $weatherData)
            )
        );
    }
}
