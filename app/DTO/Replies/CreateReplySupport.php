<?php

namespace App\DTO\Replies;

use App\Http\Requests\StoreReplyRequest;

class CreateReplySupport
{
    public function __construct(
        public string $supportId,
        public string $content,
    ) {
    }

    public static function makeFromRequest(StoreReplyRequest $request): self
    {
        return new self(
            $request->support_id,
            $request->content,
        );
    }
}
