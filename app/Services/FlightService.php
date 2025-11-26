<?php

namespace App\Services;

class FlightService
{
    public function searchFlights($origin, $destination)
    {
        // Mock data
        return [
            [
                'flight_number' => 'IB1234',
                'airline' => 'Iberia',
                'origin' => $origin,
                'destination' => $destination,
                'departure' => '10:00 AM',
                'price' => '200 EUR'
            ],
            [
                'flight_number' => 'RY4567',
                'airline' => 'Ryanair',
                'origin' => $origin,
                'destination' => $destination,
                'departure' => '02:00 PM',
                'price' => '150 EUR'
            ]
        ];
    }

    public function getFlightStatus($flightNumber)
    {
        // Mock status
        return "El vuelo $flightNumber está programado y a tiempo.";
    }
}
