<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\Request;

use HttpClientBundle\Test\RequestTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\DifyMediaBundle\Request\GetAnnotationListRequest;

/**
 * @internal
 */
#[CoversClass(GetAnnotationListRequest::class)]
final class GetAnnotationListRequestTest extends RequestTestCase
{
    public function testRequestHasCorrectPathWithDefaults(): void
    {
        $request = new GetAnnotationListRequest();

        self::assertSame('/apps/annotations', $request->getRequestPath());
    }

    public function testRequestHasCorrectPathWithCustomPage(): void
    {
        $request = new GetAnnotationListRequest(2);

        self::assertSame('/apps/annotations?page=2', $request->getRequestPath());
    }

    public function testRequestHasCorrectPathWithCustomLimit(): void
    {
        $request = new GetAnnotationListRequest(1, 50);

        self::assertSame('/apps/annotations?limit=50', $request->getRequestPath());
    }

    public function testRequestHasCorrectPathWithCustomPageAndLimit(): void
    {
        $request = new GetAnnotationListRequest(3, 10);

        self::assertSame('/apps/annotations?page=3&limit=10', $request->getRequestPath());
    }

    public function testRequestHasCorrectMethod(): void
    {
        $request = new GetAnnotationListRequest();

        self::assertSame('GET', $request->getRequestMethod());
    }

    public function testRequestOptions(): void
    {
        $request = new GetAnnotationListRequest();
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
        $request = new GetAnnotationListRequest($page, $limit);

        self::assertSame($page, $request->getPage());
        self::assertSame($limit, $request->getLimit());
    }

    public function testDefaultValues(): void
    {
        $request = new GetAnnotationListRequest();

        self::assertSame(1, $request->getPage());
        self::assertSame(20, $request->getLimit());
    }
}
