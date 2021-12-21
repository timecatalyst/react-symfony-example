<?php

namespace App\API\Domain\Shared\DTO;

class SelectListItemModel
{
    private string $label;
    private string|int $value;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return int|string
     */
    public function getValue(): int|string
    {
        return $this->value;
    }

    /**
     * @param int|string $value
     */
    public function setValue(int|string $value): void
    {
        $this->value = $value;
    }
}