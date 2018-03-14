<?php

// Challenge: refactor these interfaces into a more sensible architecture (adding new interfaces where required)

interface FlightBookingSystemInterface
{
    public function getPossibleDestinationAirportsForOriginAirport(AirportInterface $origin);
    public function getDepartureTimes(AirportInterface $origin, AirportInterface $destination);
    public function getFlightCost(FlightRoutingInterface $flightRouting, UserInterface $user, FlightTimeInterface $flightTime);
    public function bookFlight(AirportInterface $origin, AirportInterface $destination, UserInterface $user, $time, $cost);
}

interface AirportInterface
{
    public function getAllAirports();
    /** FlightInterface $flights[]  */
    public function getFlights(array $flights):array;
    public function getFlightByTime(FlightTimeInterface $flightTime, FlightInterface $flight);
    public function getFlightByCompany(FlightTimeInterface $flightTime, FlightCompanyInterface $flightCompany);
}

interface UserInterface
{
    public function getInformation();
}


interface FlightRoutingInterface
{
  public function getWeather(AirportInterface $airport);
  public function getDistance(AirportInterface $origin, AirportInterface $destination);
}

interface FlightCompanyInterface
{
    public function getYataCode():?string;
    public function getCompanyName();
}
interface FlightInterface
{
    public function flightClass():string;
    public function getPilot(PilotInterface $pilot):int;
}

interface PilotInterface
{
    public function isAllowedToFlight():bool;
    public function allFlightTimes():int;
    public function getLastFlight():FlightTimeInterface;
    public function getCode();
}

interface FlightTimeInterface
{
    public function getDate();
    public function takeOff();
    public function landed();
    public function getFlightDuration();
    public function getDelay();

}