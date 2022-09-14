<?php

namespace App\Presenters;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Presenters\Contracts\PresenterPaginationInterface;

class PaginationPresenter implements PresenterPaginationInterface
{
    protected $paginator;

    public function __construct(LengthAwarePaginator $paginator)
    {
        $this->paginator = $paginator;
    }

    public function total(): int
    {
        return $this->paginator->total();
    }
    public function items(): array
    {
        return $this->paginator->items();
    }
    public function currentPage(): int
    {
        return $this->paginator->currentPage();
    }
    public function lastPage(): int
    {
        return $this->paginator->lastPage();
    }
    public function firstPage(): int
    {
        return $this->paginator->firstItem();
    }
}
