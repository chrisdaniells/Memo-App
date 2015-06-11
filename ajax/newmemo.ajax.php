<?php

    include $_SERVER["DOCUMENT_ROOT"].'/memo/runtime.php';

    $title =  $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $urgency = $_POST['urgency'];

    $memo = new Memo;
    $memo->addMemo($title, $description, $deadline, $urgency);

