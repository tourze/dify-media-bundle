<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Request;

use HttpClientBundle\Request\ApiRequest;

/**
 * 删除标注请求
 */
final class DeleteAnnotationRequest extends ApiRequest
{
    public function __construct(
        private readonly string $annotationId,
    ) {
    }

    public function getRequestPath(): string
    {
        return '/apps/annotations/' . $this->annotationId;
    }

    public function getRequestMethod(): string
    {
        return 'DELETE';
    }

    /**
     * @return array<string, mixed>
     */
    public function getRequestOptions(): array
    {
        return [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ];
    }

    public function getAnnotationId(): string
    {
        return $this->annotationId;
    }
}
