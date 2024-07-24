<?php

namespace App\Service;

use libphonenumber\geocoding\PhoneNumberOfflineGeocoder;
use libphonenumber\PhoneNumber;

class PhoneCountryService extends PhoneNumberOfflineGeocoder
{
    public function getCountryByNumber(PhoneNumber $number, $locale)
    {
        return $this->getCountryNameForNumber($number, $locale);
    }
}
