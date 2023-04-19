<?php
// Проверяем, были ли выбраны файлы для загрузки
if (isset($_FILES['images'])) {
    
    // Определяем каталог для сохранения загруженных файлов
    $targetDir = 'uploads/';
    
    // Создаем массив для хранения ссылок на загруженные изображения
    $imageUrls = array();
    
    // Обходим все загруженные файлы
    foreach ($_FILES['images']['name'] as $key => $name) {
        
        // Проверяем, был ли загружен файл без ошибок
        if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
            
            // Генерируем уникальное имя файла для изображения
            $fileName = uniqid() . '_' . $name;
            
            // Сохраняем изображение на сервере
            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetDir . $fileName)) {
                
                // Генерируем ссылку на изображение
                $imageUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $targetDir . $fileName;
                
                // Добавляем ссылку на изображение в массив
                $imageUrls[] = $imageUrl;
            }
        }
    }
    
    // Выводим ссылки на загруженные изображения
    foreach ($imageUrls as $imageUrl) {
        echo '<a href="' . $imageUrl . '">' . $imageUrl . '</a><br>';
    }
}
?>