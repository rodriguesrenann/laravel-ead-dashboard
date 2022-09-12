<?php

namespace App\Repositories\Contracts;


interface SupportReplyRepositoryInterface
{
    public function create(array $data): object;
}
