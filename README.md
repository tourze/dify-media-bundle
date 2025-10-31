# Dify Media Bundle

[English](README.md) | [中文](README.zh-CN.md)

Symfony Bundle for Dify AI media processing including file upload, audio transcription, and text-to-speech capabilities.

## Features

- **File Upload**: Upload files to Dify applications
- **File Preview**: Generate file previews and thumbnails
- **Audio Transcription**: Convert audio to text
- **Text-to-Speech**: Convert text to audio
- **Annotation Management**: Create, update, and delete annotations
- **Feedback System**: Handle message feedback and ratings
- **Status Monitoring**: Track annotation and media processing status

## Installation

```bash
composer require tourze/dify-media-bundle
```

## Configuration

Add the bundle to your `config/bundles.php`:

```php
return [
    // ... other bundles
    Tourze\DifyMediaBundle\DifyMediaBundle::class => ['all' => true],
];
```

## API Endpoints

- **File Upload**: Upload files for processing
- **File Preview**: Generate file previews
- **Audio to Text**: Transcribe audio files
- **Text to Audio**: Generate speech from text
- **Annotation CRUD**: Manage annotations
- **Message Feedback**: Handle user feedback
- **Status Queries**: Check processing status

## Usage

```php
// Upload a file
$uploadResult = $mediaService->uploadFile($file, $userId);

// Convert audio to text
$transcription = $mediaService->audioToText($audioFile);

// Convert text to audio
$audioResult = $mediaService->textToAudio($text, $voice);

// Create annotation
$annotation = $mediaService->createAnnotation($messageId, $content);
```

## Requirements

- PHP 8.1+
- Symfony 7.3+

## License

This bundle is released under the MIT license. See the [LICENSE](LICENSE) file for details.