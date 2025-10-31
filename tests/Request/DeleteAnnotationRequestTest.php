<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\Request;

use PHPUnit\Framework\Attributes\CoversClass;
use HttpClientBundle\Tests\Request\RequestTestCase;
use Tourze\DifyMediaBundle\Request\DeleteAnnotationRequest;

/**
 * @internal
 */
#[CoversClass(DeleteAnnotationRequest::class)]
final class DeleteAnnotationRequestTest extends RequestTestCase
{
    public function testRequestHasCorrectPath(): void
    {
        $annotationId = 'annotation-123';
        $request = new DeleteAnnotationRequest($annotationId);

        self::assertSame('/apps/annotations/annotation-123', $request->getRequestPath());
    }

    public function testRequestHasCorrectMethod(): void
    {
        $request = new DeleteAnnotationRequest('annotation-123');

        self::assertSame('DELETE', $request->getRequestMethod());
    }

    public function testRequestOptions(): void
    {
        $request = new DeleteAnnotationRequest('annotation-123');
        $options = $request->getRequestOptions();

        self::assertIsArray($options);
        self::assertArrayHasKey('headers', $options);
        self::assertIsArray($options['headers']);
        self::assertSame('application/json', $options['headers']['Content-Type']);
    }

    public function testGetAnnotationId(): void
    {
        $annotationId = 'annotation-456';
        $request = new DeleteAnnotationRequest($annotationId);

        self::assertSame($annotationId, $request->getAnnotationId());
    }
}
