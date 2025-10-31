<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\Request;

use PHPUnit\Framework\Attributes\CoversClass;
use HttpClientBundle\Tests\Request\RequestTestCase;
use Tourze\DifyMediaBundle\Request\TextToAudioRequest;

/**
 * @internal
 */
#[CoversClass(TextToAudioRequest::class)]
final class TextToAudioRequestTest extends RequestTestCase
{
    public function testRequestHasCorrectPath(): void
    {
        $request = new TextToAudioRequest('test-user');

        self::assertSame('/text-to-audio', $request->getRequestPath());
    }

    public function testRequestHasCorrectMethod(): void
    {
        $request = new TextToAudioRequest('test-user');

        self::assertSame('POST', $request->getRequestMethod());
    }

    public function testRequestOptionsWithRequiredFields(): void
    {
        $user = 'test-user';
        $request = new TextToAudioRequest($user);
        $options = $request->getRequestOptions();

        self::assertIsArray($options);
        self::assertArrayHasKey('headers', $options);
        self::assertArrayHasKey('json', $options);
        self::assertIsArray($options['headers']);
        self::assertSame('application/json', $options['headers']['Content-Type']);

        self::assertIsArray($options['json']);
        $json = $options['json'];
        self::assertSame($user, $json['user']);
        self::assertArrayNotHasKey('message_id', $json);
        self::assertArrayNotHasKey('text', $json);
    }

    public function testRequestOptionsWithAllFields(): void
    {
        $user = 'test-user';
        $messageId = 'message-123';
        $text = 'Hello world!';
        $request = new TextToAudioRequest($user, $messageId, $text);
        $options = $request->getRequestOptions();

        self::assertIsArray($options);
        self::assertArrayHasKey('json', $options);

        self::assertIsArray($options['json']);
        $json = $options['json'];
        self::assertSame($user, $json['user']);
        self::assertSame($messageId, $json['message_id']);
        self::assertSame($text, $json['text']);
    }

    public function testGetters(): void
    {
        $user = 'test-user';
        $messageId = 'message-456';
        $text = 'Convert this to audio';
        $request = new TextToAudioRequest($user, $messageId, $text);

        self::assertSame($user, $request->getUser());
        self::assertSame($messageId, $request->getMessageId());
        self::assertSame($text, $request->getText());
    }

    public function testOptionalParametersAreNull(): void
    {
        $request = new TextToAudioRequest('test-user');

        self::assertNull($request->getMessageId());
        self::assertNull($request->getText());
    }
}
