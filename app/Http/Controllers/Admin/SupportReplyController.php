<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupportReplyService;
use App\Http\Requests\SupportReplyRequest;

class SupportReplyController extends Controller
{
    protected SupportReplyService $supportReplyService;

    public function __construct(SupportReplyService $supportReplyService)
    {
        $this->supportReplyService = $supportReplyService;
    }

    public function store(SupportReplyRequest $request)
    {
        $this->supportReplyService->create($request->validated());

        return redirect()->back();
    }
}
