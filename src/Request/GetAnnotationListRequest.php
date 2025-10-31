<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Request;

use HttpClientBundle\Request\ApiRequest;

/**
 * 获取标注列表请求
 */
final class GetAnnotationListRequest extends ApiRequest
{
    public function __construct(
        private readonly int $page = 1,
        private readonly int $limit = 20,
    ) {
    }

    public function getRequestPath(): string
    {
        $queryParams = [];

        if (1 !== $this->page) {
            $queryParams['page'] = (string) $this->page;
        }

        if (20 !== $this->limit) {
            $queryParams['limit'] = (string) $this->limit;
        }

        $path = '/apps/annotations';

        if ([] !== $queryParams) {
            $path .= '?' . http_build_query($queryParams);
        }

        return $path;
    }

    public function getRequestMethod(): string
    {
        return 'GET';
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

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
