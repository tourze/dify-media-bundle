# Dify 媒体包

[English](README.md) | [中文](README.zh-CN.md)

用于 Dify AI 媒体处理的 Symfony Bundle，包括文件上传、音频转录和文字转语音功能。

## 功能特性

- **文件上传**：向 Dify 应用上传文件
- **文件预览**：生成文件预览和缩略图
- **音频转录**：将音频转换为文字
- **文字转语音**：将文字转换为音频
- **标注管理**：创建、更新和删除标注
- **反馈系统**：处理消息反馈和评分
- **状态监控**：跟踪标注和媒体处理状态

## 安装

```bash
composer require tourze/dify-media-bundle
```

## 配置

将 bundle 添加到 `config/bundles.php`：

```php
return [
    // ... 其他 bundles
    Tourze\DifyMediaBundle\DifyMediaBundle::class => ['all' => true],
];
```

## API 端点

- **文件上传**：上传文件进行处理
- **文件预览**：生成文件预览
- **音频转文字**：转录音频文件
- **文字转音频**：从文字生成语音
- **标注 CRUD**：管理标注
- **消息反馈**：处理用户反馈
- **状态查询**：检查处理状态

## 使用方法

```php
// 上传文件
$uploadResult = $mediaService->uploadFile($file, $userId);

// 音频转文字
$transcription = $mediaService->audioToText($audioFile);

// 文字转音频
$audioResult = $mediaService->textToAudio($text, $voice);

// 创建标注
$annotation = $mediaService->createAnnotation($messageId, $content);
```

## 系统要求

- PHP 8.1+
- Symfony 7.3+

## 许可证

此 bundle 基于 MIT 许可证发布。详细信息请查看 [LICENSE](LICENSE) 文件。