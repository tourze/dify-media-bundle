<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\Request;

use PHPUnit\Framework\Attributes\CoversClass;
use HttpClientBundle\Tests\Request\RequestTestCase;
use Tourze\DifyMediaBundle\Request\FileUploadRequest;

/**
 * @internal
 */
#[CoversClass(FileUploadRequest::class)]
final class FileUploadRequestTest extends RequestTestCase
{
    public function testRequestHasCorrectPath(): void
    {
        $request = new FileUploadRequest('test-user', '/path/to/file.txt');

        self::assertSame('/files/upload', $request->getRequestPath());
    }

    public function testRequestHasCorrectMethod(): void
    {
        $request = new FileUploadRequest('test-user', '/path/to/file.txt');

        self::assertSame('POST', $request->getRequestMethod());
    }

    public function testRequestOptions(): void
    {
        $request = new FileUploadRequest('test-user', '/tmp/test-file.txt');
        $options = $request->getRequestOptions();

        self::assertIsArray($options);
        self::assertArrayHasKey('headers', $options);
        self::assertArrayHasKey('multipart', $options);
        self::assertIsArray($options['headers']);
        self::assertSame('multipart/form-data', $options['headers']['Content-Type']);

        self::assertIsArray($options['multipart']);
        $multipart = $options['multipart'];
        self::assertCount(2, $multipart);

        // Check user field
        self::assertIsArray($multipart[0]);
        self::assertSame('user', $multipart[0]['name']);
        self::assertSame('test-user', $multipart[0]['contents']);

        // Check file field
        self::assertIsArray($multipart[1]);
        self::assertSame('file', $multipart[1]['name']);
        self::assertSame('test-file.txt', $multipart[1]['filename']);
    }

    public function testGetters(): void
    {
        $user = 'test-user';
        $filePath = '/path/to/file.txt';
        $request = new FileUploadRequest($user, $filePath);

        self::assertSame($user, $request->getUser());
        self::assertSame($filePath, $request->getFilePath());
    }
}
