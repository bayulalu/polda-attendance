<?php

namespace App\Helpers;

class GeoHelper
{

    const EARTH_RADIUS = 6371000; // Radius bumi dalam meter

    public static function haversine(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $dlat = deg2rad($lat2 - $lat1);
        $dlon = deg2rad($lon2 - $lon1);
        $a = sin($dlat / 2) * sin($dlat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = self::EARTH_RADIUS * $c;
        return $distance; // Jarak dalam meter
    }
}
