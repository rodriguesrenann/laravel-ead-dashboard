<?php

namespace App\Presenters\Contracts;

interface PresenterPaginationInterface
{
    public function total(): int;
    public function items(): array;
    public function currentPage(): int;
    public function lastPage(): int;
    public function firstPage(): int;
}
