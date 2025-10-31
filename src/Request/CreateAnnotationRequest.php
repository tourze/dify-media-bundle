<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Request;

use HttpClientBundle\Request\ApiRequest;

/**
 * 创建标注请求
 */
final class CreateAnnotationRequest extends ApiRequest
{
    public function __construct(
        private readonly string $question,
        private readonly string $answer,
    ) {
    }

    public function getRequestPath(): string
    {
        return '/apps/annotations';
    }

    public function getRequestMethod(): string
    {
        return 'POST';
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
            'json' => [
                'question' => $this->question,
                'answer' => $this->answer,
            ],
        ];
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }
}
