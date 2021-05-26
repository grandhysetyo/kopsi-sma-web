<?php
require_once "pelengkap.php"; 
if($_GET){                //if 'val' parameter is set (i.e. is in the url)

        $chunck= 100;
        $npsn= isset($_GET['npsn']) ? $_GET['npsn'] : '';
		
		
        $key = 'B6FBAC04-461C-46D5-BBCC-F762AFA295BC';
        $URLNYA = 'http://helpdesk.dikdasmen.kemdikbud.go.id/WS_PD_SMA/WS.php';
        //$URLNYA = "http://".$_SERVER['HTTP_HOST']."/ws_pd/WS.php";

       
        $param = array(
                'act'=>'getSKL',
                'skl_id'=>'',
                'kode_wil'=>'',
                'pd_id'=>'',
                'nisn'=>'',
                'npsn'=>$npsn,
                'API'=>$key,
                'chunck'=>$chunck,
                'page'=>'',
        ); 
       
        $params = prepareSend($param);

        $url = $URLNYA."?params={$params}";             
        $result = file_get_contents($url, false);

        $hasil = prepareReceive($result);
        echo json_encode($hasil['data'][0]);                   
}

    
        

        ?>