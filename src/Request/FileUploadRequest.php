<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Request;

use HttpClientBundle\Request\ApiRequest;

/**
 * 上传文件请求
 */
final class FileUploadRequest extends ApiRequest
{
    public function __construct(
        private readonly string $user,
        private readonly string $filePath,
    ) {
    }

    public function getRequestPath(): string
    {
        return '/files/upload';
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
                'Content-Type' => 'multipart/form-data',
            ],
            'multipart' => [
                [
                    'name' => 'user',
                    'contents' => $this->user,
                ],
                [
                    'name' => 'file',
                    'contents' => function () {
                        return fopen($this->filePath, 'r');
                    },
                    'filename' => basename($this->filePath),
                ],
            ],
        ];
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }
}
