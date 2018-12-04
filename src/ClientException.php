<?php

namespace BookUnited\Http;

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
     * @param array $errors
     * @return array
     */
    public function getErrors(array $errors): array
    {
       return $this->errors;
    }
}