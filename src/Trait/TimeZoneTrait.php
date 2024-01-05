<?php 
namespace App\Trait;

    trait TimeZoneTrait
    {
        protected function changeTimeZone(mixed $timeZoneId): void
        {
             \date_default_timezone_set($timeZoneId);
        }
    }