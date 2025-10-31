<?php

declare(strict_types=1);

namespace Tourze\DifyMediaBundle\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\DifyMediaBundle\DifyMediaBundle;
use Tourze\PHPUnitSymfonyKernelTest\AbstractBundleTestCase;

/**
 * @internal
 */
#[CoversClass(DifyMediaBundle::class)]
#[RunTestsInSeparateProcesses]
final class DifyMediaBundleTest extends AbstractBundleTestCase
{
    // 所有 Bundle 测试已由 AbstractBundleTestCase 自动提供
    // 包括：Bundle 实例化、名称验证、路径验证、构建测试、依赖检查等
}
