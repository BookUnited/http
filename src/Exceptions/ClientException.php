<?php

namespace BookUnited\Http\Exceptions;

use Exception;

class ClientException extends Exception
{
    /** @var array */
    protected $errors = [];

    /**
     * @param string $message
     * @param array $errors
     */
    public function __construct(
        string $message,
        array $errors = []
    )
    {
        $this->errors = $errors;

        parent::__construct($message);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
       return $this->errors;
    }
}