<?php

class DateUtils {
    public static function DatumCesky(string $date): string
    {
        $englishDate = (new Datetime($date))->format('l d. F Y H:i');

        $men = [
            'January', 'February', 'March', 'April', 'May',
            'June', 'July', 'August', 'September', 'October',
            'November', 'December'
        ];

        $mcz = [
            'ledna', 'února', 'března', 'dubna', 'května',
            'června', 'července', 'srpna', 'září', 'října',
            'listopadu', 'prosince'
        ];

        $englishDate = str_replace($men, $mcz, $englishDate);

        $den = [
            'Monday', 'Tuesday', 'Wednesday', 'Thursday',
            'Friday', 'Saturday', 'Sunday'
        ];

        $dcz = [
            'Pondělí', 'Úterý', 'Středa', 'Čtvrtek',
            'Pátek', 'Sobota', 'Neděle'
        ];

        return str_replace($den, $dcz, $englishDate);
    }
}