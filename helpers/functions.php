<?php 

    function get_slot_dates(): array 
    {
        return [
            [
                'title'     => date('d-m-Y'),
                'value'     => strtotime('today'),
            ],
            [
                'title'     => date('d-m-Y', strtotime("+1 day")),
                'value'     => strtotime("+1 day"),
            ]
        ];
    }


    function data_sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }

?>