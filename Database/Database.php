<?php

class Database
{
    public $conn;
    public $method;
    public $fillable = ['link'];
    public $errors = [];
    public $shorty = '';
    public function __construct($data)
    {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=linkcut', 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


        $this->method = $data;
        // -----
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!array_key_exists($this->fillable[0], $this->method)) {
                echo "Error :@";
                return;
            } else {
            }
            $this->validate();
        } else {
            $this->redirect();
        }
    }

    public function validate()
    {
        $field = $this->method['link'];
        $field = htmlspecialchars($field);

        if (empty($field)) {
            echo 'This field can\'t be empty';
        } elseif (strlen($field) < 5) {
            echo 'URL cant be this short';
        } else {
            $this->insert();
            $this->show_link();
        }
    }

    // Add to Database the link and provide short-link

    public function insert()
    {
        $length = 7;
        $shortenlink = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
        $link = $this->method['link'];


        $query = "INSERT INTO `links` (`link`,`shorten_link`) VALUES ('$link','$shortenlink')";
        $prepared = $this->conn->prepare($query);
        $prepared->execute();

        // Fetching That Link Bruv;

        $query = "SELECT `shorten_link` FROM `links` WHERE `link` = '$link'";
        $prepared = $this->conn->prepare($query);
        $prepared->execute();

        $result = $prepared->fetchAll(PDO::FETCH_ASSOC);

        $the_link = $result[0]['shorten_link'];

        $the_link = "localhost/linkcut/?l=$the_link";

        return  $the_link;
    }

    public function show_link()
    {
        $this->shorty = $this->insert();
    }

    public function redirect()
    {
        $link = $this->method;
        $query = "SELECT `link` FROM `links` WHERE `shorten_link` = '$link'";
        $prepared = $this->conn->prepare($query);
        $prepared->execute();

        $result = $prepared->fetchAll(PDO::FETCH_ASSOC);

        $redirect_link = $result[0]['link'];

        echo $redirect_link;

        header('Location: ' . $redirect_link);
    }
}
