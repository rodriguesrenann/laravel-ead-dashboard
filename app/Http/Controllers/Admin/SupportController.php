<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Support\SupportEnum;
use Illuminate\Http\Request;
use App\Services\SupportService;
use App\Http\Controllers\Controller;
use App\Models\Support;

class SupportController extends Controller
{
    protected SupportService $supportService;

    public function __construct(SupportService $supportService)
    {
        $this->supportService = $supportService;
    }

    public function index()
    {
        $supports = $this->supportService->getFilteredSupports(request('status', ''));
        $statusOptions = SupportEnum::cases();

        return view('admin.supports.index', compact('supports', 'statusOptions'));
    }

    public function show(string $supportId)
    {
        $support = $this->supportService->getSupport($supportId);

        if (!$support) {
            return redirect()->back();
        }

        return view('admin.supports.show', compact('support'));
    }
}
