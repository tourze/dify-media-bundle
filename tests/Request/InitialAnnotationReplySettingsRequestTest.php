<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\Request;

use HttpClientBundle\Test\RequestTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\DifyMediaBundle\Request\InitialAnnotationReplySettingsRequest;

/**
 * @internal
 */
#[CoversClass(InitialAnnotationReplySettingsRequest::class)]
final class InitialAnnotationReplySettingsRequestTest extends RequestTestCase
{
    public function testRequestHasCorrectPath(): void
    {
        $action = 'test-action';
        $request = new InitialAnnotationReplySettingsRequest($action, 0.8);

        self::assertSame('/apps/annotation-reply/test-action', $request->getRequestPath());
    }

    public function testRequestHasCorrectMethod(): void
    {
        $request = new InitialAnnotationReplySettingsRequest('action', 0.7);

        self::assertSame('POST', $request->getRequestMethod());
    }

    public function testRequestOptionsWithRequiredFields(): void
    {
        $action = 'test-action';
        $scoreThreshold = 0.85;
        $request = new InitialAnnotationReplySettingsRequest($action, $scoreThreshold);
        $options = $request->getRequestOptions();

        self::assertIsArray($options);
        self::assertArrayHasKey('headers', $options);
        self::assertArrayHasKey('json', $options);
        self::assertIsArray($options['headers']);
        self::assertSame('application/json', $options['headers']['Content-Type']);

        self::assertIsArray($options['json']);
        $json = $options['json'];
        self::assertSame($scoreThreshold, $json['score_threshold']);
        self::assertArrayNotHasKey('embedding_provider_name', $json);
        self::assertArrayNotHasKey('embedding_model_name', $json);
    }

    public function testRequestOptionsWithAllFields(): void
    {
        $action = 'test-action';
        $scoreThreshold = 0.9;
        $providerName = 'openai';
        $modelName = 'text-embedding-ada-002';
        $request = new InitialAnnotationReplySettingsRequest($action, $scoreThreshold, $providerName, $modelName);
        $options = $request->getRequestOptions();

        self::assertIsArray($options);
        self::assertArrayHasKey('json', $options);

        self::assertIsArray($options['json']);
        $json = $options['json'];
        self::assertSame($scoreThreshold, $json['score_threshold']);
        self::assertSame($providerName, $json['embedding_provider_name']);
        self::assertSame($modelName, $json['embedding_model_name']);
    }

    public function testGetters(): void
    {
        $action = 'test-action';
        $scoreThreshold = 0.75;
        $providerName = 'openai';
        $modelName = 'text-embedding-ada-002';
        $request = new InitialAnnotationReplySettingsRequest($action, $scoreThreshold, $providerName, $modelName);

        self::assertSame($action, $request->getAction());
        self::assertSame($scoreThreshold, $request->getScoreThreshold());
        self::assertSame($providerName, $request->getEmbeddingProviderName());
        self::assertSame($modelName, $request->getEmbeddingModelName());
    }

    public function testOptionalParametersAreNull(): void
    {
        $request = new InitialAnnotationReplySettingsRequest('action', 0.8);

        self::assertNull($request->getEmbeddingProviderName());
        self::assertNull($request->getEmbeddingModelName());
    }
}
