<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Request;

use HttpClientBundle\Request\ApiRequest;

/**
 * 查询标注回复初始设置任务状态请求
 */
final class GetAnnotationReplyStatusRequest extends ApiRequest
{
    public function __construct(
        private readonly string $action,
        private readonly string $jobId,
    ) {
    }

    public function getRequestPath(): string
    {
        return '/apps/annotation-reply/' . $this->action . '/status/' . $this->jobId;
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

    public function getAction(): string
    {
        return $this->action;
    }

    public function getJobId(): string
    {
        return $this->jobId;
    }
}
