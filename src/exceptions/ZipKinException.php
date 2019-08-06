<?php
/**
 * Created by PhpStorm.
 * User: blackhades
 * Date: 8/6/19
 * Time: 3:32 PM
 */

namespace BlackHades\PHPZipkin\exceptions;


use Throwable;

class ZipKinException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}