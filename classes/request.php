<?php

class request{
    public $connect;
    public $rights = ['send_messages','service_api','debug'];
    public $send_messages;
    public $service_api;
    public $debug;

    function get_value_rights(){
        $send_messages = 0;
        $service_api = 0;
        $debug = 0;
    }
};

?>