<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\Request;

use HttpClientBundle\Test\RequestTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\DifyMediaBundle\Request\GetAnnotationReplyStatusRequest;

/**
 * @internal
 */
#[CoversClass(GetAnnotationReplyStatusRequest::class)]
final class GetAnnotationReplyStatusRequestTest extends RequestTestCase
{
    public function testRequestHasCorrectPath(): void
    {
        $action = 'test-action';
        $jobId = 'job-123';
        $request = new GetAnnotationReplyStatusRequest($action, $jobId);

        self::assertSame('/apps/annotation-reply/test-action/status/job-123', $request->getRequestPath());
    }

    public function testRequestHasCorrectMethod(): void
    {
        $request = new GetAnnotationReplyStatusRequest('action', 'job-id');

        self::assertSame('GET', $request->getRequestMethod());
    }

    public function testRequestOptions(): void
    {
        $request = new GetAnnotationReplyStatusRequest('action', 'job-id');
        $options = $request->getRequestOptions();

        self::assertIsArray($options);
        self::assertArrayHasKey('headers', $options);
        self::assertIsArray($options['headers']);
        self::assertSame('application/json', $options['headers']['Content-Type']);
    }

    public function testGetters(): void
    {
        $action = 'test-action';
        $jobId = 'job-456';
        $request = new GetAnnotationReplyStatusRequest($action, $jobId);

        self::assertSame($action, $request->getAction());
        self::assertSame($jobId, $request->getJobId());
    }
}
