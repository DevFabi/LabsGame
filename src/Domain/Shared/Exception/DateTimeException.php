<?php


namespace App\Domain\Shared\Exception;


class DateTimeException extends \Exception
{
    public function __construct(\Exception $e)
    {
        parent::__construct('Datetime Malformed or not valid', 500, $e);
    }
}