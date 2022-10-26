<?php 
  // Необходимые заголовки
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/db.php';
  include_once '../../models/post.php';

  // Создание нового экземпляра БД и подключение
  $database = new db();
  $db = $database->connect();

  // Создание нового экземпляра модели
  $post = new Post($db);

  // Запрос на запись данных
  $result = $post->read();
  // Колличесто строк
  $num = $result->rowCount();

  // Проверка на налиие данных
  if($num > 0) {
    // Массив данных
    $posts_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'id' => $id,
        'fio' => $fio,
        'company' => $company,
        'phone' => $phone,
        'email' => $email,
        'birthday' => $birthday,
        'photo' => $photo
      );

      // Запись масива данных
      array_push($posts_arr, $post_item);
    }

    // Кодирование JSON и вывод
    echo json_encode($posts_arr);

  } else {
    // Условие с отсутсвием записей
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }