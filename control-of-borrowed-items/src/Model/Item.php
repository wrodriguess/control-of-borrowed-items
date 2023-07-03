<?php

namespace Will\Borrowed\Model;
class Item
{
    private int $id;
    private string $description;
    private float $price;

    public function __construct(
        string $description,
        float $price = 0
    )
    {
        $this->description = $description;
        $this->price = $price;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}