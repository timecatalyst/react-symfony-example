<?php

namespace App\API\Exception;

use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends UnprocessableEntityHttpException
{
    const MESSAGE = 'The request contained one or more validation errors.';

    private array $errors = [];

    public function __construct(
        ConstraintViolationListInterface $validationErrors,
        Exception $previous = null,
        $code = 0)
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

        parent::__construct(self::MESSAGE, $previous, $code);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}