<?php

namespace App\Support\Helpers;

class DocumentHelper
{
    /**
     * @param $number
     * @param $prefix
     * @return string
     */
    public static function generateNumber($id, $prefix): string
    {
        return 'EV' . $prefix  .'-'. sprintf('%07d', $id);
    }
}
