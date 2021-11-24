<?php

namespace App\Features\Users\DTO;

use App\Features\Users\Constraints\UserEmailIsUnique;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUpdateUserModel
{
    /**
     * @Assert\NotBlank(message = "Name is required.")
     */
    private string $name;

    /**
     * @Assert\NotBlank(message = "Email is required.")
     * @Assert\Email(message = "Must be a valid email address.")
     * @UserEmailIsUnique()
     */
    private string $email;

    /**
     * @Assert\Choice(
     *     choices = {"male", "female", "transgendered"},
     *     message = "Invalid gender selection."
     * )
     */
    private string $gender;

    private bool $active;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
}