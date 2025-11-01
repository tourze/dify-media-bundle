<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\Request;

use HttpClientBundle\Test\RequestTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\DifyMediaBundle\Request\CreateAnnotationRequest;

/**
 * @internal
 */
#[CoversClass(CreateAnnotationRequest::class)]
final class CreateAnnotationRequestTest extends RequestTestCase
{
    public function testRequestHasCorrectPath(): void
    {
        $request = new CreateAnnotationRequest('test question', 'test answer');

        self::assertSame('/apps/annotations', $request->getRequestPath());
    }

    public function testRequestHasCorrectMethod(): void
    {
        $request = new CreateAnnotationRequest('test question', 'test answer');

        self::assertSame('POST', $request->getRequestMethod());
    }

    public function testRequestOptions(): void
    {
        $question = 'What is the capital of France?';
        $answer = 'Paris';
        $request = new CreateAnnotationRequest($question, $answer);
        $options = $request->getRequestOptions();

        self::assertIsArray($options);
        self::assertArrayHasKey('headers', $options);
        self::assertArrayHasKey('json', $options);
        self::assertIsArray($options['headers']);
        self::assertSame('application/json', $options['headers']['Content-Type']);

        self::assertIsArray($options['json']);
        $json = $options['json'];
        self::assertSame($question, $json['question']);
        self::assertSame($answer, $json['answer']);
    }

    public function testGetters(): void
    {
        $question = 'What is the capital of France?';
        $answer = 'Paris';
        $request = new CreateAnnotationRequest($question, $answer);

        self::assertSame($question, $request->getQuestion());
        self::assertSame($answer, $request->getAnswer());
    }
}
