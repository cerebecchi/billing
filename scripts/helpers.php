<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Log;

if (!function_exists('sendDataToLog')) {

    /**
     * @param string $logIdentifier
     * @param array $data
     * @param bool $showUrl
     *
     * @return void
     */
    function sendDataToLog(string $logIdentifier, array $data = [], bool $showUrl = false)
    {
        $data['url'] = $showUrl && is_object(request()) ? request()->fullUrl() : null;
        $data['request'] = is_object(request()) && !empty(request()->all()) ? print_r(request()->all(), true) : null;
        $data = array_filter($data);
        Log::error($logIdentifier, $data);
    }
}

if (!function_exists('sendExceptionToLog')) {
    /**
     * @param mixed $exception
     * @param string $logIdentifier
     * @param string $optionalMessage
     * @param array $extraData
     *
     * @return void
     */
    function sendExceptionToLog($exception, string $logIdentifier, string $optionalMessage = '', array $extraData = [])
    {
        $file = $exception->getFile() . ':' . $exception->getLine();
        $errorData = [
            'message' => $optionalMessage,
            'file' => $file,
            'exceptionMessage' => $exception->getMessage(),
        ];
        $errorData = array_merge($errorData, $extraData);
        sendDataToLog($logIdentifier, $errorData);
    }
}