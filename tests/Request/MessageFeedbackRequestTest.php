<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\Request;

use HttpClientBundle\Test\RequestTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\DifyMediaBundle\Request\MessageFeedbackRequest;

/**
 * @internal
 */
#[CoversClass(MessageFeedbackRequest::class)]
final class MessageFeedbackRequestTest extends RequestTestCase
{
    public function testRequestHasCorrectPath(): void
    {
        $messageId = 'message-123';
        $request = new MessageFeedbackRequest($messageId, 'test-user');

        self::assertSame('/messages/message-123/feedbacks', $request->getRequestPath());
    }

    public function testRequestHasCorrectMethod(): void
    {
        $request = new MessageFeedbackRequest('message-id', 'user');

        self::assertSame('POST', $request->getRequestMethod());
    }

    public function testRequestOptionsWithRequiredFields(): void
    {
        $messageId = 'message-123';
        $user = 'test-user';
        $request = new MessageFeedbackRequest($messageId, $user);
        $options = $request->getRequestOptions();

        self::assertIsArray($options);
        self::assertArrayHasKey('headers', $options);
        self::assertArrayHasKey('json', $options);
        self::assertIsArray($options['headers']);
        self::assertSame('application/json', $options['headers']['Content-Type']);

        self::assertIsArray($options['json']);
        $json = $options['json'];
        self::assertSame($user, $json['user']);
        self::assertArrayNotHasKey('rating', $json);
        self::assertArrayNotHasKey('content', $json);
    }

    public function testRequestOptionsWithAllFields(): void
    {
        $messageId = 'message-123';
        $user = 'test-user';
        $rating = 'like';
        $content = 'Great response!';
        $request = new MessageFeedbackRequest($messageId, $user, $rating, $content);
        $options = $request->getRequestOptions();

        self::assertIsArray($options);
        self::assertArrayHasKey('json', $options);

        self::assertIsArray($options['json']);
        $json = $options['json'];
        self::assertSame($user, $json['user']);
        self::assertSame($rating, $json['rating']);
        self::assertSame($content, $json['content']);
    }

    public function testGetters(): void
    {
        $messageId = 'message-456';
        $user = 'test-user';
        $rating = 'dislike';
        $content = 'Could be better';
        $request = new MessageFeedbackRequest($messageId, $user, $rating, $content);

        self::assertSame($messageId, $request->getMessageId());
        self::assertSame($user, $request->getUser());
        self::assertSame($rating, $request->getRating());
        self::assertSame($content, $request->getContent());
    }

    public function testOptionalParametersAreNull(): void
    {
        $request = new MessageFeedbackRequest('message-id', 'user');

        self::assertNull($request->getRating());
        self::assertNull($request->getContent());
    }
}
