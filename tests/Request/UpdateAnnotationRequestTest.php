<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\Request;

use HttpClientBundle\Test\RequestTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\DifyMediaBundle\Request\UpdateAnnotationRequest;

/**
 * @internal
 */
#[CoversClass(UpdateAnnotationRequest::class)]
final class UpdateAnnotationRequestTest extends RequestTestCase
{
    public function testRequestHasCorrectPath(): void
    {
        $annotationId = 'annotation-123';
        $request = new UpdateAnnotationRequest($annotationId, 'question', 'answer');

        self::assertSame('/apps/annotations/annotation-123', $request->getRequestPath());
    }

    public function testRequestHasCorrectMethod(): void
    {
        $request = new UpdateAnnotationRequest('annotation-id', 'question', 'answer');

        self::assertSame('PUT', $request->getRequestMethod());
    }

    public function testRequestOptions(): void
    {
        $annotationId = 'annotation-123';
        $question = 'What is the updated question?';
        $answer = 'This is the updated answer';
        $request = new UpdateAnnotationRequest($annotationId, $question, $answer);
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
        $annotationId = 'annotation-456';
        $question = 'Updated question?';
        $answer = 'Updated answer';
        $request = new UpdateAnnotationRequest($annotationId, $question, $answer);

        self::assertSame($annotationId, $request->getAnnotationId());
        self::assertSame($question, $request->getQuestion());
        self::assertSame($answer, $request->getAnswer());
    }
}
