<?php

namespace Src\Services\Avatar;

use Core\Session;
use Src\Models\PhotoModel;

class PhotoService 
{
    private Session $session;
    private PhotoModel $photoModel;

    public function __construct(Session $session)
    {   
        $this->session = $session;
        $this->photoModel = new PhotoModel();
    }

    public function handlerPhoto(string|int $id_employee, array $photo_data)
    {   

        if (($photo_data["image"]["error"]) === 0) {

                $uploadDir = 'uploads/';
                $fileTmp = $photo_data['image']['tmp_name'];// шлях до локальної дерикторії тимчасового зберігання на сервері
                $fileName = basename($photo_data['image']['name']);// обрізає слеші віндовс, лінокс
                $fileSize = $photo_data['image']['size'];
                $typeFile = mime_content_type($fileTmp);

                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxSize = 2 * 1024 * 1024;
                
                if (!in_array($typeFile, $allowedTypes)) {
                    $this->session->add('errorPhoto', "⛔ Дозволено лише JPG, PNG, GIF.");
                } elseif ($fileSize > $maxSize) { 
                    $this->session->add('errorPhoto', "⛔ Файл завеликий. Максимум 2 МБ.");
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
                            if (isset($id_employee)) {
                                $this->photoModel->addPhotoEmployee($destination, (int)$id_employee);

                                $id_user = $this->session->get('employee');

                                if ($id_employee == $id_user['id_employee']) {
                                    //$this->session->add($id_user['photo'], $destination);
                                    //$this->session->add($id_user, $destination);
                                    array_merge($this->session->get('employee'), [
                                        'photo'  => $destination
                                    ]);
                                }
                                
                                return true;

                            } else {
                                $this->session->add('errorPhoto', "❌ Спочатку авторезуйтесь.");
                            }
                        
                        } else {
                            $this->session->add('errorPhoto', "❌ Помилка при збереженні файлу.");
                        }
                    } else { 
                        $this->session->add('errorPhoto', "❌ Файл існує!");
                    }
                }
                
        } else {
            $this->session->add('errorPhoto',"❌ Файл не обрано або сталася помилка.");
        }

        return false;
    }

}