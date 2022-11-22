<?php

namespace App\Support\Helpers;

class ServiceHelper
{
    /**
     * @return string
     */
    public static function gatewayApi(): string
    {
        return  env('GATEWAY_SERVICE_HOST') . '/api/';
    }

    /**
     * @return string
     */
    public static function imsApi(): string
    {
        return  env('IMS_SERVICE_HOST') . '/api/';
    }

    /**
     * @return string
     */
    public static function wmsApi(): string
    {
        return  env('WMS_API_HOST', 'http://192.168.3.29') . '/WMSTest/hs/WMSExchange/';
    }

    /**
     * @return string
     */
    public static function rmsApi(): string
    {
        return  env('RMS_API_HOST', 'http://192.168.18.224:8090') . '/API_WebIntegration/hs/api/';
    }
}
