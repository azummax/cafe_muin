<?php
include_once("../../../common.php");

if ($_FILES['file']['name']) {
    if (!$_FILES['file']['error']) {
        $name = md5(uniqid(rand(), true));
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $filename = $name . '.' . $ext;
        
        $upload_dir = G5_DATA_PATH.'/editor/';
        if(!is_dir($upload_dir)) {
            @mkdir($upload_dir, G5_DIR_PERMISSION);
            @chmod($upload_dir, G5_DIR_PERMISSION);
        }
        
        $ym = date('ym', G5_SERVER_TIME);
        $upload_dir = $upload_dir.$ym.'/';
        if(!is_dir($upload_dir)) {
            @mkdir($upload_dir, G5_DIR_PERMISSION);
            @chmod($upload_dir, G5_DIR_PERMISSION);
        }

        $destination = $upload_dir . $filename;
        $location = $_FILES["file"]["tmp_name"];
        if(move_uploaded_file($location, $destination)) {
            echo trim(G5_DATA_URL.'/editor/'.$ym.'/' . $filename);
        } else {
            header('HTTP/1.1 400 Bad Request');
            echo '파일 이동 실패. 권한을 확인해주세요.';
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo '업로드 용량 초과 또는 기타 서버 오류: '.$_FILES['file']['error'];
    }
} else {
    header('HTTP/1.1 400 Bad Request');
    echo '파일이 업로드되지 않았습니다.';
}
?>