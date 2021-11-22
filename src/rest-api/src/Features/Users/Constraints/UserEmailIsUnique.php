<?php

namespace App\Features\Users\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UserEmailIsUnique extends Constraint
{
    public string $message = 'Email is already in use.';
}
