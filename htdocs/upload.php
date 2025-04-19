<?php
$uploadDir = __DIR__ . '/uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if (!empty($_FILES['files'])) {
    foreach ($_FILES['files']['name'] as $index => $name) {
        $tmpName = $_FILES['files']['tmp_name'][$index];
        $name = basename($name);
        $targetPath = $uploadDir . $name;

        if (move_uploaded_file($tmpName, $targetPath)) {
            echo "Uploaded: $name<br>";
        } else {
            echo "Failed to upload: $name<br>";
        }
    }
} else {
    echo "No files received.";
}
?>
