<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\Request;

use PHPUnit\Framework\Attributes\CoversClass;
use HttpClientBundle\Tests\Request\RequestTestCase;
use Tourze\DifyMediaBundle\Request\FilePreviewRequest;

/**
 * @internal
 */
#[CoversClass(FilePreviewRequest::class)]
final class FilePreviewRequestTest extends RequestTestCase
{
    public function testRequestHasCorrectPathWithoutAttachment(): void
    {
        $fileId = 'file-123';
        $request = new FilePreviewRequest($fileId);

        self::assertSame('/files/file-123/preview', $request->getRequestPath());
    }

    public function testRequestHasCorrectPathWithAttachment(): void
    {
        $fileId = 'file-123';
        $request = new FilePreviewRequest($fileId, true);

        self::assertSame('/files/file-123/preview?as_attachment=true', $request->getRequestPath());
    }

    public function testRequestHasCorrectMethod(): void
    {
        $request = new FilePreviewRequest('file-123');

        self::assertSame('GET', $request->getRequestMethod());
    }

    public function testRequestOptions(): void
    {
        $request = new FilePreviewRequest('file-123');
        $options = $request->getRequestOptions();

        self::assertIsArray($options);
        self::assertArrayHasKey('headers', $options);
        self::assertIsArray($options['headers']);
        self::assertSame('*/*', $options['headers']['Accept']);
    }

    public function testGetters(): void
    {
        $fileId = 'file-456';
        $request = new FilePreviewRequest($fileId, true);

        self::assertSame($fileId, $request->getFileId());
        self::assertTrue($request->isAsAttachment());
    }

    public function testDefaultAsAttachmentIsFalse(): void
    {
        $request = new FilePreviewRequest('file-123');

        self::assertFalse($request->isAsAttachment());
    }
}
