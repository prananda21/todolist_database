<?php

namespace Repository {

    use Entity\TodoList;

    interface TodolistRepository
    {

        function save(TodoList $todoList): void;

        function remove(int $number): bool;

        function findAll(): array;
    }

    class TodolistRepositoryImpl implements TodolistRepository
    {

        public array $todoList = array();

        private \PDO $connection;

        public function __construct(\PDO $connection)
        {
            $this->connection = $connection;
        }

        function save(Todolist $todoList): void
        {
            // $number = sizeof($this->todoList) + 1;
            // $this->todoList[$number] = $todoList;
            $sql = "INSERT INTO todolist(todo) VALUES (?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$todoList->getTodo()]);
        }

        function remove(int $number): bool
        {
            // if ($number > sizeof($this->todoList)) {
            //     return false;
            // }

            // for ($i = $number; $i < sizeof($this->todoList); $i++) {
            //     $this->todoList[$i] = $this->todoList[$i + 1];
            // }

            // unset($this->todoList[sizeof($this->todoList)]);

            // return true;
            $sql = "SELECT id FROM todolist where id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);

            if ($statement->fetch()) {
                // condition id exist
                $sql = "DELETE FROM todolist WHERE id = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$number]);

                return true;
            } else {
                // condition id doesn't exist
                return false;
            }
        }

        function findAll(): array
        {
            // return $this->todoList;
            $sql = "SELECT id, todo FROM todolist";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $result = [];
            foreach ($statement as $row) {
                $todoList = new TodoList();
                $todoList->setId($row["id"]);
                $todoList->setTodo($row['todo']);

                $result[] = $todoList;
            }

            return $result;
        }
    }
}
