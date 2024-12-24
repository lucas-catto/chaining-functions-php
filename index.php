<?php

/*
// each method returns an anonymous object
function crud() {

    return new class { // anonymous object

        private $items = [];

        public function create() {
            echo "create\n";
            return $this;
        }

        public function read() {
            echo "read\n";
            return $this;
        }

        public function update() {
            echo "update\n";
            return $this;
        }

        public function delete() {
            echo "delete\n";
            return $this;
        }
    };
}

crud()->create()->read()->update()->delete();
*/

function message(string $message = "") {

    if (!isset($message)) {
        die('message undefined.');
    }

    echo 'Message: ' . $message . "\n";
}

function crud() {
    
    return new class
    {
        private $pdo;

        public function __construct()
        {
            $this->pdo = new PDO("mysql:host=localhost;dbname=functions", "root", "");
        }

        public function create(string $name = '')
        {
            if ($name == '') { // !isset($name) || $name == ''
                die("\$name is undefined.\n");
            }
            
            $query = $this->pdo->prepare('INSERT INTO users VALUES (null, ?)');
            $query->execute([$name]);

            message('create ' . $name);
            
            return $this;
        }

        public function read(int $id = null, bool $show = true)
        {    
            if ($id == null) {
                $query = $this->pdo->prepare('SELECT * FROM users');
                $query->execute();
            } else {
                $query = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
                $query->execute([$id]);
            }

            if ($show) {

                $items = $query->fetchAll(PDO::FETCH_OBJ);
    
                foreach ($items as $item) {
                    echo $item->id . " - ".$item->name . "\n";
                }
            }

            return $this;
        }

        public function update(int $id = null, string $name = '')
        {    
            if ($id == null || $name == '') {
                die('id or name undefined.');
            }

            $query = $this->pdo->prepare('UPDATE users SET name = ? WHERE id = ?');
            $query->execute([$name, $id]);

            message('update ' . $name);

            return $this;
        }

        public function delete(int $id = null)
        {
            if ($id == null) {
                die('id undefined.');
            }

            //message("delete: ".$this->read($id));
            
            $query = $this->pdo->prepare('DELETE FROM users WHERE id = ?');
            $query->execute([$id]);

            return $this;
        }
    };
}

// crud()->create('lucas')->read(6)->update(6, 'php')->delete(6);
// crud()->delete(1);
// crud()->update(1, 'laravel')->read();
// crud()->create('lucas')->read(1);

crud()->create();

crud()->read();
