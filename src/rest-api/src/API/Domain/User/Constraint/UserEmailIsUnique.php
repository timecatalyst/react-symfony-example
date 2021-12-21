<?php

namespace App\API\Domain\User\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UserEmailIsUnique extends Constraint
{
    public string $message = 'Email is already in use.';
}
