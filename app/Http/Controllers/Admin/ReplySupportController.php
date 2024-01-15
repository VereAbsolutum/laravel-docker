<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Replies\CreateReplySupport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplyRequest;
use App\Models\ReplySupport;
use App\Services\ReplySupportService;
use App\Services\SupportService;
use Illuminate\Http\Request;

class ReplySupportController extends Controller
{
    public function __construct(
        protected SupportService $supportService,
        protected ReplySupportService $replyService,
    ) {
    }

    public function index(string $id)
    {
        if (!$support = $this->supportService->findOne($id)) {
            return back();
        }

        $replies = $this->replyService->getAllBySupportId($support->id);

        return view('admin.supports.replies.replies', compact('support', 'replies'));
    }
    public function store(StoreReplyRequest $request)
    {
        $this->replyService->createNew(dto: CreateReplySupport::makeFromRequest($request));

        return redirect()
            ->route('replies.index', $request->support_id)
            ->with('message', 'Cadastrado com sucesso');
    }


    public function destroy(string $supportId, string | int $id)
    {
        $this->replyService->delete($id);

        return redirect()
            ->route('replies.index', $supportId)
            ->with('message', 'Deletado com sucesso');;
    }
}
