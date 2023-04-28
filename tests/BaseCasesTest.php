<?php

use Illuminate\Support\Facades\Storage;
use Mi\MiImageUtility\MiImageUtility;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

beforeEach(function () {
    $this->image = fake()->imageUrl();
});

it('invalid image', function () {
    $imageData = MiImageUtility::createImage(
        Storage::disk('public')->path('mi-image-test-4.png'),
        ['w' => 100, 'h' => 50, 'fit' => 'crop', 'bg' => 'CCC']
    );
    expect($imageData)->not()->toBeInstanceOf(BinaryFileResponse::class);
});

it('image from public path', function () {
    copy($this->image, public_path('mi-image-test.png'));
    $imageData = MiImageUtility::createImage(
        public_path('mi-image-test.png'),
        ['w' => 100, 'h' => 50, 'fit' => 'crop', 'bg' => 'CCC']
    );
    expect($imageData)->toBeInstanceOf(BinaryFileResponse::class);
    unlink(public_path('mi-image-test.png'));
});

it('reduce image quality to 50', function () {
    copy($this->image, public_path('mi-image-test-1.png'));
    $imageData = MiImageUtility::createImage(
        public_path('mi-image-test-1.png'),
        ['w' => 100, 'h' => 50, 'fit' => 'crop', 'q' => 50, 'bg' => 'CCC']
    );
    expect($imageData)->toBeInstanceOf(BinaryFileResponse::class);
    unlink(public_path('mi-image-test-1.png'));
});

it('change image format from png to jpg', function () {
    copy($this->image, public_path('mi-image-test-2.png'));
    $imageData = MiImageUtility::createImage(
        public_path('mi-image-test-2.png'),
        ['w' => 100, 'h' => 50, 'fit' => 'crop', 'q' => 50, 'fm' => 'jpg', 'bg' => 'CCC']
    );
    expect($imageData)->toBeInstanceOf(BinaryFileResponse::class);
    unlink(public_path('mi-image-test-2.png'));
});

it('image from storage path', function () {
    copy($this->image, Storage::disk('public')->path('mi-image-test-3.png'));
    $imageData = MiImageUtility::createImage(
        Storage::disk('public')->path('mi-image-test-3.png'),
        ['w' => 100, 'h' => 50, 'fit' => 'crop', 'bg' => 'CCC']
    );
    expect($imageData)->toBeInstanceOf(BinaryFileResponse::class);
    Storage::disk('public')->delete('mi-image-test-3.png');
});

it('invalid image type', function () {
    $imageData = MiImageUtility::createImage(
        'https://www.mindinventory.com/static/media/logo-mind-inventory-w.8514e2e8.svg',
        ['w' => 100, 'h' => 50, 'fit' => 'crop', 'fm' => 'png', 'bg' => 'CCC']
    );
    expect($imageData)->not()->toBeInstanceOf(BinaryFileResponse::class);
});

it('remote image', function () {
    $imageData = MiImageUtility::createImage(
        'https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png',
        ['w' => 100, 'h' => 50, 'fit' => 'crop', 'fm' => 'jpg', 'bg' => 'CCC']
    );
    expect($imageData)->toBeInstanceOf(BinaryFileResponse::class);
});


