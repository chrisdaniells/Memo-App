<?php

function printPreviews($memos)
{
    $previewOutput = '';

    if (!empty($memos)) {
        $count = 0;
        foreach ($memos as $memo) {
            $previewOutput .=   '<pr class="'.$memo['priority'].'" data-id="'.$memo['ID'].'" >
                                    <h3>'.$memo['title'].'</h3>
                                    <p>'.$memo['description'].'</p>
                                </pr>';
            ++$count;
        }
    } else {
        $previewOutput = '<p class="no-memos">No Memos Yet.</p>';
    }


    return $previewOutput;
}

function getDoneButton($id) {
    $buttonOutput = '
        <div id="done" data-done="'.$id.'">
            <p>Done</p>
        </div>';

    return $buttonOutput;
}
