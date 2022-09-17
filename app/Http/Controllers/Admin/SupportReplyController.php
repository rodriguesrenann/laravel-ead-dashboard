<?php

namespace App\Http\Controllers\Admin;

use App\Events\SupportReplied;
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
        $supportReply = $this->supportReplyService->create($request->validated());

        event(new SupportReplied($supportReply));

        return redirect()->back();
    }
}
