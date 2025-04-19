<?php
$baseDir = __DIR__ . '/uploads/';
$baseURL = '/uploads/';

$currentPath = isset($_GET['path']) ? $_GET['path'] : '';
$fullPath = realpath($baseDir . $currentPath);

if (strpos($fullPath, realpath($baseDir)) !== 0) {
    // Prevent path traversal attacks
    http_response_code(403);
    echo json_encode(["error" => "Access denied."]);
    exit;
}

$files = [];
$folders = [];

if (is_dir($fullPath)) {
    foreach (scandir($fullPath) as $item) {
        if ($item === '.' || $item === '..') continue;

        $itemPath = $fullPath . DIRECTORY_SEPARATOR . $item;
        $relativePath = ltrim($currentPath . '/' . $item, '/');

        if (is_dir($itemPath)) {
            $folders[] = ['name' => $item, 'path' => $relativePath];
        } elseif (is_file($itemPath)) {
            $files[] = ['name' => $item, 'path' => $relativePath];
        }
    }
}

header('Content-Type: application/json');
echo json_encode(['folders' => $folders, 'files' => $files]);
