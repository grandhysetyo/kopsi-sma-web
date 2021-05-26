<?php
function get_siswa_by_nisn($nisn){
		
    $chunck= 100;

    $key = 'B6FBAC04-461C-46D5-BBCC-F762AFA295BC';
    $url = 'http://helpdesk.dikdasmen.kemdikbud.go.id/WS_PD_SMA/WS.php';
    $param = array(
        'act'=> 'getPD',
        'skl_id'=>'',
        'kode_wil'=>'',
        'pd_id'=>'',
        'nisn'=>$nisn,
        'npsn'=>'',
        'API'=>$key,
        'chunck'=>$chunck,
        'page'=>'',
    ); 
    $params = $this->prepareSend($param);

    $url = $url."?params={$params}";
    $result = file_get_contents($url, false, $context);		
    $hasil = $this->prepareReceive($result);
    
    $hasil_filter = [];
    if(empty($hasil['data'])){
        return NULL;
    } else {
        $hasil_filter = $hasil['data'][0];
        unset($hasil_filter['email_pd']);
        unset($hasil_filter['pendidikan_ayah']);
        unset($hasil_filter['pendidikan_ibu']);
        unset($hasil_filter['pendidikan_wali']);
        unset($hasil_filter['pekerjaan_ayah']);
        unset($hasil_filter['pekerjaan_ibu']);
        unset($hasil_filter['pekerjaan_wali']);
        unset($hasil_filter['penghasilan_ayah']);
        unset($hasil_filter['penghasilan_ibu']);
        unset($hasil_filter['penghasilan_wali']);
    }
    return $hasil_filter;
}
?>