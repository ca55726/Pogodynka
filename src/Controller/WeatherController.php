<?php

namespace App\Controller;

use App\Entity\Place;
use App\Repository\MeasurementRepository;
use App\Repository\PlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    #[Route('/weather/{country}/{city}', name: 'app_weather')]
    public function City(string $country, string $city, PlaceRepository $placeRepository, MeasurementRepository $measurementRepository): Response
    {
        $city = str_replace('-', ' ', $city);

        $place = $placeRepository->findOneByCountryAndCity($country, $city);

        if (!$place) {
            throw $this->createNotFoundException('Nie znaleziono takiego miasta.');
        }

        $measurements = $measurementRepository->findByPlace($place);

        return $this->render('weather/city.html.twig', [
            'place' => $place,
            'measurements' => $measurements,
        ]);
    }
}
