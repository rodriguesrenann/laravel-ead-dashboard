<?php

namespace App\Repositories;

use App\Models\SupportReply;
use App\Repositories\Contracts\SupportReplyRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SupportReplyRepository implements SupportReplyRepositoryInterface
{
    protected SupportReply $model;

    public function __construct(SupportReply $model)
    {
        $this->model = $model;
    }

    public function create(array $data): object
    {
        $data['admin_id'] = Auth::user()->id;
        return $this->model->create($data);
    }
}
