<?php

namespace App\Features\Users\Constraints;

use App\Repository\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class UserEmailIsUniqueValidator extends ConstraintValidator
{
    private RequestStack $requestStack;
    private UserRepository $userRepository;

    public function __construct(
        RequestStack $requestStack,
        UserRepository $userRepository)
    {
        $this->requestStack = $requestStack;
        $this->userRepository = $userRepository;
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @throws NonUniqueResultException
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        $request = $this->requestStack->getCurrentRequest();
        $attributes = $request->attributes->all();

        if (!$constraint instanceof UserEmailIsUnique)
            throw new UnexpectedTypeException($constraint, UserEmailIsUnique::class);

        if (null === $value || '' === $value) return;

        if (!is_string($value))
            throw new UnexpectedValueException($value, 'string');

        if ($this->isEmailInUse($value, $attributes['userId'] ?? null))
            $this->context->buildViolation($constraint->message)->addViolation();
    }

    /**
     * @param string $email
     * @param int|null $userId
     *
     * @return bool
     *
     * @throws NonUniqueResultException
     */
    private function isEmailInUse(string $email, int $userId = null): bool
    {
        $query = $this->userRepository->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $email);

        if ($userId)
            $query = $query->andWhere('u.id != :id')
                ->setParameter('id', $userId);

        return $query->getQuery()->getOneOrNullResult() !== null;
    }
}
