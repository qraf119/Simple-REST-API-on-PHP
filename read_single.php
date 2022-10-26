<?php 
  // Необходимые заголовки
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/db.php';
  include_once '../../models/Post.php';

  // Создание нового экземпляра БД и подключение
  $database = new db();
  $db = $database->connect();

  // Создание нового экземпляра модели
  $post = new Post($db);

  // Получение ID
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Получение записи
  $post->read_single();

  // Создание массива
  $post_arr = array(
    'id' => $id,
    'fio' => $fio,
    'company' => $company,
    'phone' => $phone,
    'email' => $email,
    'birthday' => $birthday,
    'photo' => $photo
  );

  // Кодирование JSON
  print_r(json_encode($post_arr));