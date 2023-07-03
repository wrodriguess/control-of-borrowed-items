<?php

namespace Will\Borrowed\Model;

class Borrow
{
    private int $id;
    private int $itemId;
    private string $itemDescription;
    private string $userName;
    private string $type;
    private string $date;
    private string $expectedDate;
    private string $effectiveDate;

    public function __construct(
        int $itemId,
        string $userName,
        string $type,
        string $expectedDate
    ){
        $this->itemId = $itemId;
        $this->userName = $userName;
        $this->type = $type;
        $this->expectedDate = $expectedDate;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function itemId(): int
    {
        return $this->itemId;
    }

    public function itemDescription(): string
    {
        return $this->itemDescription;
    }

    public function setItemDescription(string $itemDescription): void
    {
        $this->itemDescription = $itemDescription;
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function expectedDate(): string
    {
        return $this->expectedDate;
    }

    public function effectiveDate(): string
    {
        return $this->effectiveDate;
    }

}