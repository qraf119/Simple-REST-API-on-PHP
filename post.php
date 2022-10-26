<?php 
  class Post {

    private $conn;
    private $table = 'notebook';

    // Данные
    public $id;
    public $fio;
    public $company;
    public $phone;
    public $email;
    public $birthday;
    public $photo;

    // Конструктор DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Чтение записей
    public function read() {
      // Запрос для БД
      $query = "SELECT id, fio, company, phone, email, birthday, photo FROM " . $this->table . "";
      
      // Подготовка к выполнению запроса
      $stmt = $this->conn->prepare($query);

      // Выполнение запроса
      $stmt->execute();

      return $stmt;
    }

    // Чтение одной записи
    public function read_single() {
          // Запрос для БД
          $query = "SELECT
          id, fio, company, phone, email, birthday, photo
          FROM
          ". $this->db_table ."
          WHERE 
          id = ?
          LIMIT 0,1";

          // Подготовка к выполнению запроса
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Выполнение запроса
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Запись данных
          $this->phone = $row['phone'];
          $this->email = $row['email'];
          $this->birthday = $row['birthday'];
          $this->fio = $row['fio'];
          $this->company = $row['company'];
          $this->photo = $row['photo'];
    }

    // Создание записи
    public function create() {
          // Запрос для БД
          $query = 'INSERT INTO ' . $this->table . ' SET phone = :phone, email = :email, birthday = :birthday, fio = :fio, company = :company, photo = :photo';

          // Подготовка к выполнению запроса
          $stmt = $this->conn->prepare($query);

          // Очистка данных
          $this->phone = htmlspecialchars(strip_tags($this->phone));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->birthday = htmlspecialchars(strip_tags($this->birthday));
          $this->fio = htmlspecialchars(strip_tags($this->fio));
          $this->company = htmlspecialchars(strip_tags($this->company));
          $this->photo = htmlspecialchars(strip_tags($this->photo));

          // Привязка нвых данных
          $stmt->bindParam(':phone', $this->phone);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':birthday', $this->birthday);
          $stmt->bindParam(':fio', $this->fio);
          $stmt->bindParam(':company', $this->company);
          $stmt->bindParam(':photo', $this->photo);

          // Выполнение запроса
          if($stmt->execute()) {
            return true;
      }

      // Вывод ошибки
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Удаление записи
    public function delete() {
          // Запрос для БД
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Подготовка к выполнению запроса
          $stmt = $this->conn->prepare($query);

          // Очистка данных
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Привязка нвых данных
          $stmt->bindParam(':id', $this->id);

          // Выполнение запроса
          if($stmt->execute()) {
            return true;
          }

          // Вывод ошибки
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }