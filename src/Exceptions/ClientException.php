<?php

namespace BookUnited\Http\Exceptions;

use Exception;

class ClientException extends Exception
{
    /** @var array */
    protected $errors = [];

    /**
     * @param string $message
     * @param int    $code
     * @param array  $errors
     */
    public function __construct(
        string $message,
        int $code,
        array $errors = []
    )
    {
        $this->errors = $errors;

        parent::__construct($message, $code);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
       return $this->errors;
    }
}