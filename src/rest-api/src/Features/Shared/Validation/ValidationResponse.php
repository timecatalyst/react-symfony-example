<?php

namespace App\Features\Validation;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationResponse
{
    private int $code = Response::HTTP_UNPROCESSABLE_ENTITY;

    private string $message = 'The request contained one or more validation errors.';

    private array $errors = [];

    /**
     * ValidationResponse constructor.
     * @param ConstraintViolationListInterface $validationErrors
     */
    public function __construct(ConstraintViolationListInterface $validationErrors)
    {
        foreach ($validationErrors as $error)
        {
            $property = $error->getPropertyPath();
            $message = $error->getMessage();

            if (array_key_exists($property, $this->errors))
                array_push($this->errors[$property], $message);
            else
                $this->errors[$property] = [$message];
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array { return $this->errors; }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}