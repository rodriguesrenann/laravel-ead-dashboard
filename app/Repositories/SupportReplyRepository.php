<?php

namespace App\Repositories;

use App\Models\SupportReply;
use App\Repositories\Contracts\SupportReplyRepositoryInterface;

class SupportReplyRepository implements SupportReplyRepositoryInterface
{
    protected SupportReply $model;

    public function __construct(SupportReply $model)
    {
        $this->model = $model;
    }

    public function create(array $data): object
    {
        $data['admin_id'] = '49da60fb-c71b-4e3f-9d14-f508affaac0f';
        return $this->model->create($data);
    }
}
