<?php

function set_rights($request, $i, $rows){
    if ($request->rights[$i] == 'send_messages' && $rows[$request->rights[$i]]>$request->send_messages)
        $request->send_messages = $rows[$request->rights[$i]];
    if ($request->rights[$i] == 'service_api' && $rows[$request->rights[$i]]>$request->service_api)
        $request->service_api = $rows[$request->rights[$i]];
    if ($request->rights[$i] == 'debug' && $rows[$request->rights[$i]]>$request->debug)
        $request->debug = $rows[$request->rights[$i]];
}
?>