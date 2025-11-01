<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\Request;

use HttpClientBundle\Test\RequestTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\DifyMediaBundle\Request\AudioToTextRequest;

/**
 * @internal
 */
#[CoversClass(AudioToTextRequest::class)]
final class AudioToTextRequestTest extends RequestTestCase
{
    public function testRequestHasCorrectPath(): void
    {
        $request = new AudioToTextRequest('test-user', '/path/to/audio.mp3');

        self::assertSame('/audio-to-text', $request->getRequestPath());
    }

    public function testRequestHasCorrectMethod(): void
    {
        $request = new AudioToTextRequest('test-user', '/path/to/audio.mp3');

        self::assertSame('POST', $request->getRequestMethod());
    }

    public function testRequestOptions(): void
    {
        $request = new AudioToTextRequest('test-user', '/tmp/test-audio.mp3');
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
        self::assertSame('test-audio.mp3', $multipart[1]['filename']);
    }

    public function testGetters(): void
    {
        $user = 'test-user';
        $filePath = '/path/to/audio.mp3';
        $request = new AudioToTextRequest($user, $filePath);

        self::assertSame($user, $request->getUser());
        self::assertSame($filePath, $request->getFilePath());
    }
}
