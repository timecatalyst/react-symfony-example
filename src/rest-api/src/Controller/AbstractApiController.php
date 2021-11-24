<?php

namespace App\Controller;

use App\Features\Validation\ValidationResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class AbstractApiController extends AbstractFOSRestController
{
    /**
     * @param mixed $payload
     * @return Response
     */
    protected function okResponse(mixed $payload = null): Response
    {
        $code = $payload ? Response::HTTP_OK : Response::HTTP_NO_CONTENT;
        return $this->buildResponse($payload, $code);
    }

    /**
     * @param mixed $payload
     * @return Response
     */
    protected function createdResponse(mixed $payload = null): Response
    {
        return $this->buildResponse($payload, Response::HTTP_CREATED);
    }

    /**
     * @param ConstraintViolationListInterface $validationErrors
     * @return Response
     */
    protected function unprocessableEntityResponse(
        ConstraintViolationListInterface $validationErrors): Response
    {
        $validationResponse = new ValidationResponse($validationErrors);
        return $this->buildResponse($validationResponse, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @return Response
     */
    protected function notFoundResponse(): Response
    {
        return $this->buildResponse(null, Response::HTTP_NOT_FOUND);
    }

    /**
     * @param mixed $payload
     * @param int $code
     * @return Response
     */
    private function buildResponse(mixed $payload, int $code): Response
    {
        $view = $this->view($payload, $code);
        return $this->handleView($view);
    }
}