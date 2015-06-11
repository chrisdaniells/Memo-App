<?php

    class Memo
    {
        public function __construct()
        {

        }

        public function addMemo($title, $description, $deadline, $urgency)
        {
            $db = MySqlDatabase::getInstance();
            $con = $db->getConnection();

            $stmt = $con->prepare("INSERT INTO memo (title, description, deadline, priority) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $title, $description, $deadline, $urgency);
            $stmt->execute();

            if (false===$stmt) {
                $returnValue = false;
            } else {
                $returnValue = true;
            }

            $stmt->close();

            return $returnValue;
        }

        public function deleteMemo($id)
        {
            $db = MySqlDatabase::getInstance();
            $con = $db->getConnection();

            $stmt = $con->prepare("DELETE FROM memo WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

    }
