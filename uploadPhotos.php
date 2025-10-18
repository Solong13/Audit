<?php
session_start();
include_once ('config/connectionToDB.php');
include_once ('helpers.php');   
include_once ('helpers_for_DB.php');   
/* Придумати захист від спаму на сервер одного і того ж фото
    ствр папку куди буду сейвить певні дані
    +Ств змінну де буде зберігатися файл зі шляхом збереження у користувача
    +Ств змінну яка буде викор basename і обрізати слеші імені
    +Ств зміннну з даним типом файла mime_content_type()

    чи є тип даних в списку даних
    чи якщо розмір більший за заданий 
    інакше створюємо дерикторію is_dir через mkdir

    потім інікальне імя через uniqid і pathinfo
    та повне імя і куди зберігати в папку файл
    Зберегти даний файл в нашу дерикторію зберігання файлів

*/

$errorsOfPhotos = [];
$success = null;
if (isset($_POST['submit']) && ($_FILES["image"]["error"]) === 0) {
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
                        addPhotoEmployee($destination, $_SESSION['employee']['id_employee'], $dbh);
                        $_SESSION['employee'] = 
                            [
                                "photo" => $destination,
                            ];
                        redirect('/public/index');
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
        
}else {
    $errorsOfPhotos['error']  = "❌ Файл не обрано або сталася помилка.";
}

if (!empty($errorsOfPhotos['error'])) {
    $_SESSION['photoError'] = $errorsOfPhotos;
    redirect('/public/index');
    exit();
} 
