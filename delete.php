<?php 
  // Необходимые заголовки
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/db.php';
  include_once '../../models/Post.php';

  // Создание нового экземпляра БД и подключение
  $database = new db();
  $db = $database->connect();

  // Создание нового экземпляра модели
  $post = new Post($db);

  // Получение имеющихся данных
  $data = json_decode(file_get_contents("php://input"));

  // Установка id для обновления
  $post->id = $data->id;

  // Удаление записи
  if($post->delete()) {
    echo json_encode(
      array('message' => 'Post Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Deleted')
    );
  }