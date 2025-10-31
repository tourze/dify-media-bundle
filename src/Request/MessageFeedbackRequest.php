<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Request;

use HttpClientBundle\Request\ApiRequest;

/**
 * 消息反馈（点赞）请求
 */
final class MessageFeedbackRequest extends ApiRequest
{
    public function __construct(
        private readonly string $messageId,
        private readonly string $user,
        private readonly ?string $rating = null,
        private readonly ?string $content = null,
    ) {
    }

    public function getRequestPath(): string
    {
        return '/messages/' . $this->messageId . '/feedbacks';
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
            'user' => $this->user,
        ];

        // 可选参数
        if (null !== $this->rating) {
            $body['rating'] = $this->rating;
        }

        if (null !== $this->content) {
            $body['content'] = $this->content;
        }

        return [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => $body,
        ];
    }

    public function getMessageId(): string
    {
        return $this->messageId;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}
