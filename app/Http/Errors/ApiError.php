<?php

namespace App\Http\Errors;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

readonly class ApiError implements Arrayable
{
    public function __construct(
        public int $status,
        public string $type,
        public string $title,
        public string $detail,
        public string $instance,
        public array $additional = [],
    ) {}

    public function toArray(): array
    {
        $payload = [
            'status' => $this->status,
            'type' => $this->type,
            'title' => $this->title,
            'detail' => $this->detail,
            'instance' => $this->instance,
            'timestamp' => Carbon::now()->toAtomString(),
        ];

        if (! empty($this->additional)) {
            $payload['additional'] = $this->additional;
        }

        return $payload;
    }
}
