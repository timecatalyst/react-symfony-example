<?php

namespace App\Features\Shared\Validation;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;

class ValidationErrorsSubscriber implements EventSubscriberInterface
{
    private const VALIDATION_ERRORS_ARGUMENT = 'validationErrors';

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER_ARGUMENTS => ['onKernelController', 0],
        ];
    }

    public function onKernelController(ControllerArgumentsEvent $event): void
    {
        if (!$event->isMainRequest()) return;

        $request = $event->getRequest();
        if (!in_array($request->getMethod(), [Request::METHOD_POST, Request::METHOD_PUT], true)) return;

        $errors = $request->attributes->get(self::VALIDATION_ERRORS_ARGUMENT);
        if (!$errors || 0 === $errors->count()) return;

        throw new ValidationException($errors);
    }
}