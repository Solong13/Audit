<?php

$errorsOfPhotos = [];
$success = null;
$id_employee = null;
$marker_user = false;

if (isset($_POST['submit_employee'])) {
    $id_employee = $_POST["id_employee"];
} else {
    $id_employee = $_SESSION['employee']['id_employee'];
    $marker_user = true;
}

if (($_FILES["image"]["error"]) === 0) {

        $uploadDir = 'uploads/';
        $fileTmp = $_FILES['image']['tmp_name'];// шлях до локальної дерикторії тимчасового зберігання на сервері
        $fileName = basename($_FILES['image']['name']);// обрізає слеші віндовс, лінокс
        $fileSize = $_FILES['image']['size'];
        $typeFile = mime_content_type($fileTmp);

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024; // 2 МБ
        
        
        if (!in_array($typeFile, $allowedTypes)) {
            $errorsOfPhotos['error'] = "⛔ Дозволено лише JPG, PNG, GIF.";
        } elseif ($fileSize > $maxSize) {
            $errorsOfPhotos['error'] = "⛔ Файл завеликий. Максимум 2 МБ.";
        } else {
            // cтворення папки, якщо немає
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Унікальне ім'я файлу
            $newFileName = uniqid('_img') . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            $destination = $uploadDir . $newFileName;

            if (!file_exists($destination)) {
                if (move_uploaded_file($fileTmp, $destination)) {
                    //echo "✅ Файл успішно завантажено: <a href='$destination'>Переглянути</a>";
                   // $success = "✅ Файл успішно завантажено";

                    if (isset($_SESSION["employee"])) {
                        addPhotoEmployee($destination, $id_employee, $dbh);
                        if ($marker_user) {
                            $_SESSION['employee'] = 
                                [
                                    "photo" => $destination,
                                ];
                        }
                        header("Location: ?page=portfolio");
                        exit();
                    } else {
                        $errorsOfPhotos['error']  = "❌ Спочатку авторезуйтесь";
                    }
                   
                } else {
                    $errorsOfPhotos['error'] = "❌ Помилка при збереженні файлу.";
                }
            } else { 
                $errorsOfPhotos['error']  = "❌ Файл існує!";
            }
         
        }
        
} else {
    $errorsOfPhotos['error']  = "❌ Файл не обрано або сталася помилка.";
}

if (!empty($errorsOfPhotos['error'])) {
    $_SESSION['error'] = $errorsOfPhotos;
    header("Location: ?page=portfolio");
    exit();
} 
