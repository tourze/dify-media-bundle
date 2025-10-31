<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Request;

use HttpClientBundle\Request\ApiRequest;

/**
 * 文字转语音请求
 */
final class TextToAudioRequest extends ApiRequest
{
    public function __construct(
        private readonly string $user,
        private readonly ?string $messageId = null,
        private readonly ?string $text = null,
    ) {
    }

    public function getRequestPath(): string
    {
        return '/text-to-audio';
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
        if (null !== $this->messageId) {
            $body['message_id'] = $this->messageId;
        }

        if (null !== $this->text) {
            $body['text'] = $this->text;
        }

        return [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => $body,
        ];
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getMessageId(): ?string
    {
        return $this->messageId;
    }

    public function getText(): ?string
    {
        return $this->text;
    }
}
