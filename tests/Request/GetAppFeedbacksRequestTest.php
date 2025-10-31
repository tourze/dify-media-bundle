<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\Request;

use PHPUnit\Framework\Attributes\CoversClass;
use HttpClientBundle\Tests\Request\RequestTestCase;
use Tourze\DifyMediaBundle\Request\GetAppFeedbacksRequest;

/**
 * @internal
 */
#[CoversClass(GetAppFeedbacksRequest::class)]
final class GetAppFeedbacksRequestTest extends RequestTestCase
{
    public function testRequestHasCorrectPathWithDefaults(): void
    {
        $request = new GetAppFeedbacksRequest();

        self::assertSame('/app/feedbacks', $request->getRequestPath());
    }

    public function testRequestHasCorrectPathWithCustomPage(): void
    {
        $request = new GetAppFeedbacksRequest(2);

        self::assertSame('/app/feedbacks?page=2', $request->getRequestPath());
    }

    public function testRequestHasCorrectPathWithCustomLimit(): void
    {
        $request = new GetAppFeedbacksRequest(1, 50);

        self::assertSame('/app/feedbacks?limit=50', $request->getRequestPath());
    }

    public function testRequestHasCorrectPathWithCustomPageAndLimit(): void
    {
        $request = new GetAppFeedbacksRequest(3, 10);

        self::assertSame('/app/feedbacks?page=3&limit=10', $request->getRequestPath());
    }

    public function testRequestHasCorrectMethod(): void
    {
        $request = new GetAppFeedbacksRequest();

        self::assertSame('GET', $request->getRequestMethod());
    }

    public function testRequestOptions(): void
    {
        $request = new GetAppFeedbacksRequest();
        $options = $request->getRequestOptions();

        self::assertIsArray($options);
        self::assertArrayHasKey('headers', $options);
        self::assertIsArray($options['headers']);
        self::assertSame('application/json', $options['headers']['Content-Type']);
    }

    public function testGetters(): void
    {
        $page = 2;
        $limit = 50;
        $request = new GetAppFeedbacksRequest($page, $limit);

        self::assertSame($page, $request->getPage());
        self::assertSame($limit, $request->getLimit());
    }

    public function testDefaultValues(): void
    {
        $request = new GetAppFeedbacksRequest();

        self::assertSame(1, $request->getPage());
        self::assertSame(20, $request->getLimit());
    }
}
