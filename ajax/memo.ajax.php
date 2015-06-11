<?php

$memoID = $_GET['id'];

include $_SERVER["DOCUMENT_ROOT"].'/memo/runtime.php';

$memo = $memos->extractIndividualMemoDetails($memoBank, $memoID);

$memoOutput = '
    <articlestrip>
        <h2>'.$memo['title'].'</h2>
        <p>Created on '.date('jS F Y', strtotime($memo['date_created'])).'</p>

        '.getDoneButton($id).'

    </articlestrip>

    <article>
        <p class="deadline"><span>Deadline: </span>'.date('jS F Y', strtotime($memo['deadline'])).'</p>
        <p>'.$memo['description'].'</p>
    </article>';

echo $memoOutput;
