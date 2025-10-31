<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Request;

use HttpClientBundle\Request\ApiRequest;

/**
 * 标注回复初始设置请求
 */
final class InitialAnnotationReplySettingsRequest extends ApiRequest
{
    public function __construct(
        private readonly string $action,
        private readonly float $scoreThreshold,
        private readonly ?string $embeddingProviderName = null,
        private readonly ?string $embeddingModelName = null,
    ) {
    }

    public function getRequestPath(): string
    {
        return '/apps/annotation-reply/' . $this->action;
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
        $body = [
            'score_threshold' => $this->scoreThreshold,
        ];

        // 可选参数
        if (null !== $this->embeddingProviderName) {
            $body['embedding_provider_name'] = $this->embeddingProviderName;
        }

        if (null !== $this->embeddingModelName) {
            $body['embedding_model_name'] = $this->embeddingModelName;
        }

        return [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => $body,
        ];
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getScoreThreshold(): float
    {
        return $this->scoreThreshold;
    }

    public function getEmbeddingProviderName(): ?string
    {
        return $this->embeddingProviderName;
    }

    public function getEmbeddingModelName(): ?string
    {
        return $this->embeddingModelName;
    }
}
