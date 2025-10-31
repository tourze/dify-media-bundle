<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Request;

use HttpClientBundle\Request\ApiRequest;

/**
 * 文件预览请求
 */
final class FilePreviewRequest extends ApiRequest
{
    public function __construct(
        private readonly string $fileId,
        private readonly bool $asAttachment = false,
    ) {
    }

    public function getRequestPath(): string
    {
        $path = '/files/' . $this->fileId . '/preview';

        if ($this->asAttachment) {
            $path .= '?as_attachment=true';
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
                'Accept' => '*/*',
            ],
        ];
    }

    public function getFileId(): string
    {
        return $this->fileId;
    }

    public function isAsAttachment(): bool
    {
        return $this->asAttachment;
    }
}
