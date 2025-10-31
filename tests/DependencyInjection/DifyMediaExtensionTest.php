<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests\DependencyInjection;

use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tourze\DifyMediaBundle\DependencyInjection\DifyMediaExtension;
use Tourze\PHPUnitSymfonyUnitTest\AbstractDependencyInjectionExtensionTestCase;
use Tourze\SymfonyDependencyServiceLoader\AutoExtension;

/**
 * @internal
 */
#[CoversClass(DifyMediaExtension::class)]
final class DifyMediaExtensionTest extends AbstractDependencyInjectionExtensionTestCase
{
    public function testExtensionInstantiation(): void
    {
        $extension = new DifyMediaExtension();

        // Verify the extension can be instantiated and has the expected class name
        self::assertStringContainsString('DifyMediaBundle\DependencyInjection\DifyMediaExtension', $extension::class);

        // Verify the extension has the expected inheritance through reflection
        $reflection = new \ReflectionClass($extension);
        self::assertTrue($reflection->isSubclassOf(AutoExtension::class));
    }

    public function testLoad(): void
    {
        $extension = new DifyMediaExtension();
        $container = new ContainerBuilder();

        // 设置必要的参数
        $container->setParameter('kernel.environment', 'test');
        $container->setParameter('kernel.debug', true);

        // 测试load方法不会抛出异常
        $extension->load([], $container);

        // 验证容器已正确配置
        self::assertGreaterThan(0, count($container->getDefinitions()));
    }

    public function testAlias(): void
    {
        $extension = new DifyMediaExtension();

        self::assertSame('dify_media', $extension->getAlias());
    }
}
