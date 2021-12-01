<?php

namespace App\Features\Shared\Validation;

use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ValidationErrorsNormalizer implements ContextAwareNormalizerInterface
{
    public function normalize($object, string $format = null, array $context = []): array
    {
        $exception = $context['exception'];

        return [
            "code" => $exception->getStatusCode(),
            "message" => $exception->getMessage(),
            "errors" => $exception->getErrors(),
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        if (!$data instanceof FlattenException) return false;

        $exception = $context['exception'];
        return $exception instanceof ValidationException;
    }
}