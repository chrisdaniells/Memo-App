<?php

    include $_SERVER["DOCUMENT_ROOT"].'/memo/runtime.php';

    $id =  $_GET['id'];

    $memo = new Memo;
    $memo->deleteMemo($id);

