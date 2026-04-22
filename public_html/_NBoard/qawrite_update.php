<?php
include_once('./_common.php');

/*==========================
$w == a : ?��?
$w == r : 추�?질문
$w == u : ?�정
==========================*/

if($is_guest)
    alert('?�원?�시?�면 로그?????�용??보십?�오.', G5_BBS_URL.'/login.php?url='.urlencode(G5_BBS_URL.'/qalist.php'));

$msg = array();

$write_token = get_session('ss_qa_write_token');
set_session('ss_qa_write_token', '');

$token = isset($_POST['token']) ? clean_xss_tags($_POST['token'], 1, 1) : '';

//모든 ?�원???�큰??검?�합?�다.
if (!($token && $write_token === $token))
    alert('?�큰 ?�러�???�� 불�??�니??');

// 1:1문의 설정
$qaconfig = get_qa_config();

// 관리자 체크
if (chk_multiple_admin($member['mb_id'], $qaconfig['as_admin'])) { 
	$is_admin = 'super'; 
}

if(trim($qaconfig['qa_category'])) {
    if($w != 'a') {
        $category = explode('|', $qaconfig['qa_category']);
        if(!in_array($qa_category, $category))
            alert('분류�??�바르게 지?�해 주십?�오.');
    }
} else {
    alert('1:1문의 ?�정?�서 분류�??�정??주십?�오');
}

// e-mail 체크
$qa_email = '';
if(isset($_POST['qa_email']) && $_POST['qa_email'])
    $qa_email = get_email_address(trim($_POST['qa_email']));

if($w != 'a' && $qaconfig['qa_req_email'] && !$qa_email)
    $msg[] = '?�메?�을 ?�력?�세??';

$qa_subject = '';
if (isset($_POST['qa_subject'])) {
    $qa_subject = substr(trim($_POST['qa_subject']),0,255);
    $qa_subject = preg_replace("#[\\\]+$#", "", $qa_subject);
}
if ($qa_subject == '') {
    $msg[] = '<strong>?�목</strong>???�력?�세??';
}

$qa_content = '';
if (isset($_POST['qa_content'])) {
    $qa_content = substr(trim($_POST['qa_content']),0,65536);
    $qa_content = preg_replace("#[\\\]+$#", "", $qa_content);
}
if ($qa_content == '') {
    $msg[] = '<strong>?�용</strong>???�력?�세??';
}

if (!empty($msg)) {
    $msg = implode('<br>', $msg);
    alert($msg);
}

if($qa_hp)
    $qa_hp = preg_replace('/[^0-9\-]/', '', strip_tags($qa_hp));

// 090710
if (substr_count($qa_content, '&#') > 50) {
    alert('?�용???�바르�? ?��? 코드가 ?�수 ?�함?�어 ?�습?�다.');
    exit;
}

$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST)) {
    alert("?�일 ?�는 글?�용???�기가 ?�버?�서 ?�정??값을 ?�어 ?�류가 발생?��??�니??\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시?��?리자 ?�는 ?�버관리자?�게 문의 바랍?�다.");
}

for ($i=1; $i<=5; $i++) {
    $var = "qa_$i";
    $$var = "";
    if (isset($_POST['qa_'.$i]) && $_POST['qa_'.$i]) {
        $$var = trim($_POST['qa_'.$i]);
    }
}

if($w == 'u' || $w == 'a' || $w == 'r') {
    if($w == 'a' && !$is_admin)
        alert('?��??� 관리자�??�록?????�습?�다.');

    $sql = " select * from {$g5['qa_content_table']} where qa_id = '$qa_id' ";
    if(!$is_admin) {
        $sql .= " and mb_id = '{$member['mb_id']}' ";
    }

    $write = sql_fetch($sql);

    if($w == 'u') {
        if(!$write['qa_id'])
            alert('게시글??존재?��? ?�습?�다.\\n??��?�었거나 ?�신??글???�닌 경우?�니??');

        if(!$is_admin) {
            if($write['qa_type'] == 0 && $write['qa_status'] == 1)
                alert('?��????�록??문의글?� ?�정?????�습?�다.');

            if($write['mb_id'] != $member['mb_id'])
                alert('게시글???�정??권한???�습?�다.\\n\\n?�바�?방법?�로 ?�용??주십?�오.', G5_URL);
        }
    }

    if($w == 'a') {
        if(!$write['qa_id'])
            alert('문의글??존재?��? ?�아 ?��?글???�록?????�습?�다.');

        if($write['qa_type'] == 1)
            alert('?��?글?�는 ?�시 ?��????�록?????�습?�다.');
    }
}

// ?�일개수 체크
$file_count   = 0;
$upload_count = count($_FILES['bf_file']['name']);

for ($i=1; $i<=$upload_count; $i++) {
    if($_FILES['bf_file']['name'][$i] && is_uploaded_file($_FILES['bf_file']['tmp_name'][$i]))
        $file_count++;
}

if($file_count > 2)
    alert('첨�??�일??2�??�하�??�로???�주??��??');

// ?�렉?�리가 ?�다�??�성?�니?? (?��??�도 변경하구요.)
@mkdir(G5_DATA_PATH.'/qa', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/qa', G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

// 가변 ?�일 ?�로??
$file_upload_msg = '';
$upload = array();
for ($i=1; $i<=count($_FILES['bf_file']['name']); $i++) {
    $upload[$i]['file']     = '';
    $upload[$i]['source']   = '';
    $upload[$i]['del_check'] = false;

    // ??��??체크가 ?�어?�다�??�일????��?�니??
    if (isset($_POST['bf_file_del'][$i]) && $_POST['bf_file_del'][$i]) {
        $upload[$i]['del_check'] = true;
		@unlink(G5_DATA_PATH.'/qa/'.clean_relative_paths($write['qa_file'.$i]));
		// ?�네?�삭??
if(preg_match("/\.({$config['cf_image_extension']})$/i", $write['qa_file'.$i])) {
            delete_qa_thumbnail($write['qa_file'.$i]);
        }
    }

    $tmp_file  = $_FILES['bf_file']['tmp_name'][$i];
    $filesize  = $_FILES['bf_file']['size'][$i];
    $filename  = $_FILES['bf_file']['name'][$i];
    $filename  = get_safe_filename($filename);

    // ?�버???�정??값보???�파?�을 ?�로???�다�?
if ($filename) {
        if ($_FILES['bf_file']['error'][$i] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" ?�일???�량???�버???�정('.$upload_max_filesize.')??값보???��?�??�로???????�습?�다.\\n';
            continue;
        }
        else if ($_FILES['bf_file']['error'][$i] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" ?�일???�상?�으�??�로???��? ?�았?�니??\\n';
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) {
        // 관리자가 ?�니면서 ?�정???�로???�이즈보???�다�?건너?�
        if (!$is_admin && $filesize > $qaconfig['qa_upload_size']) {
            $file_upload_msg .= '\"'.$filename.'\" ?�일???�량('.number_format($filesize).' 바이????게시?�에 ?�정('.number_format($qaconfig['qa_upload_size']).' 바이????값보???��?�??�로???��? ?�습?�다.\\n';
            continue;
        }

        //=================================================================\
        // 090714
        // ?��?지???�래???�일???�성코드�??�어 ?�로???�는 경우�?방�?
        // ?�러메세지??출력?��? ?�는??
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
             preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
            // webp ?�일??type ??18 ?��?�??�로?��? 가?�하?�록 ?�정
            if ($timg['2'] < 1 || $timg['2'] > 18)
                continue;
        }
        //=================================================================

        if ($w == 'u') {
            // 존재?�는 ?�일???�다�???��?�니??
			@unlink(G5_DATA_PATH.'/qa/'.clean_relative_paths($write['qa_file'.$i]));
			// ?��?지?�일?�면 ?�네?�삭??
if(preg_match("/\.({$config['cf_image_extension']})$/i", $write['qa_file'.$i])) {
                delete_qa_thumbnail($row['qa_file'.$i]);
            }
        }

        // ?�로그램 ?�래 ?�일�?
$upload[$i]['source'] = $filename;
        $upload[$i]['filesize'] = $filesize;

        // ?�래??문자?�이 ?�어�??�일?� -x �?붙여???�경로�? ?�더?�도 ?�행???��? 못하?�록 ??
$filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc|phar)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨�??�일 첨�???첨�??�일명에 공백???�함?�어 ?�으�??��? PC?�서 보이지 ?�거???�운로드 ?��? ?�는 ?�상???�습?�다. (길상?�의 ??090925)
        //$upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

		$upload[$i]['file'] = md5(sha1($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

		$dest_file = G5_DATA_PATH.'/qa/'.$upload[$i]['file'];

        // ?�로?��? ?�된?�면 ?�러메세지 출력?�고 죽어버립?�다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

        // ?�라�??�일???��??�을 변경합?�다.
        chmod($dest_file, G5_FILE_PERMISSION);
    }
}

if($w == '' || $w == 'a' || $w == 'r') {
    if($w == '' || $w == 'r') {
        $row = sql_fetch(" select MIN(qa_num) as min_qa_num from {$g5['qa_content_table']} ");
        $qa_num = $row['min_qa_num'] - 1;
    }

    if($w == 'a') {
        $qa_num = $write['qa_num'];
        $qa_parent = $write['qa_id'];
        $qa_related = $write['qa_related'];
		$qa_category = addslashes($write['qa_category']);
        $qa_type = 1;
        $qa_status = 1;
    }

    $sql = " insert into {$g5['qa_content_table']}
                set qa_num          = '$qa_num',
                    mb_id           = '{$member['mb_id']}',
                    qa_name         = '".addslashes($member['mb_nick'])."',
                    qa_email        = '$qa_email',
                    qa_hp           = '$qa_hp',
                    qa_type         = '$qa_type',
                    qa_parent       = '$qa_parent',
                    qa_related      = '$qa_related',
                    qa_category     = '$qa_category',
                    qa_email_recv   = '$qa_email_recv',
                    qa_sms_recv     = '$qa_sms_recv',
                    qa_html         = '$qa_html',
                    qa_subject      = '$qa_subject',
                    qa_content      = '$qa_content',
                    qa_status       = '$qa_status',
                    qa_file1        = '{$upload[1]['file']}',
                    qa_source1      = '{$upload[1]['source']}',
                    qa_file2        = '{$upload[2]['file']}',
                    qa_source2      = '{$upload[2]['source']}',
                    qa_ip           = '{$_SERVER['REMOTE_ADDR']}',
                    qa_datetime     = '".G5_TIME_YMDHIS."',
                    qa_1            = '$qa_1',
                    qa_2            = '$qa_2',
                    qa_3            = '$qa_3',
                    qa_4            = '$qa_4',
                    qa_5            = '$qa_5' ";
    sql_query($sql);

    if($w == '' || $w == 'r') {
        $qa_id = sql_insert_id();

        if($w == 'r' && $write['qa_related']) {
            $qa_related = $write['qa_related'];
        } else {
            $qa_related = $qa_id;
        }

        $sql = " update {$g5['qa_content_table']}
                    set qa_parent   = '$qa_id',
                        qa_related  = '$qa_related'
                    where qa_id = '$qa_id' ";
        sql_query($sql);

		//?�림
		$qa_admin_list = ($qaconfig['as_admin']) ? $config['cf_admin'].','.$qaconfig['as_admin'] : $config['cf_admin'];
		$qa_admin = explode(",", $qa_admin_list);
		$qa_admin = array_unique($qa_admin);

		for($i=0;$i < count($qa_admin);$i++) {

			$admin_id = trim($qa_admin[$i]);

			if(!$admin_id) continue;

			// APMS : ?��?반응 ?�록
			apms_response('qa', 'qa', '', '', $qa_id, $qa_subject, $admin_id, $member['mb_id'], $member['mb_nick']);
		}
	}

    if($w == 'a') {
        $sql = " update {$g5['qa_content_table']}
                    set qa_status = '1'
                    where qa_id = '{$write['qa_parent']}' ";
        sql_query($sql);

		// APMS : ?��?반응 ?�록
		apms_response('qa', 'qa', '', '', $write['qa_parent'], $write['qa_subject'], $write['mb_id'], '', '?��??�료');
	}
} else if($w == 'u') {
    if(!$upload[1]['file'] && !$upload[1]['del_check']) {
        $upload[1]['file'] = $write['qa_file1'];
        $upload[1]['source'] = $write['qa_source1'];
    }

    if(!$upload[2]['file'] && !$upload[2]['del_check']) {
        $upload[2]['file'] = $write['qa_file2'];
        $upload[2]['source'] = $write['qa_source2'];
    }

    $sql = " update {$g5['qa_content_table']}
                set qa_email    = '$qa_email',
                    qa_hp       = '$qa_hp',
                    qa_category = '$qa_category',
                    qa_html     = '$qa_html',
                    qa_subject  = '$qa_subject',
                    qa_content  = '$qa_content',
                    qa_file1    = '{$upload[1]['file']}',
                    qa_source1  = '{$upload[1]['source']}',
                    qa_file2    = '{$upload[2]['file']}',
                    qa_source2  = '{$upload[2]['source']}',
                    qa_1        = '$qa_1',
                    qa_2        = '$qa_2',
                    qa_3        = '$qa_3',
                    qa_4        = '$qa_4',
                    qa_5        = '$qa_5' ";
    if($qa_sms_recv)
        $sql .= ", qa_sms_recv = '$qa_sms_recv' ";
    $sql .= " where qa_id = '$qa_id' ";
    sql_query($sql);
}

// SMS ?�림
if($config['cf_sms_use'] == 'icode' && $qaconfig['qa_use_sms']) {
    if($config['cf_sms_type'] == 'LMS') {
        include_once(G5_LIB_PATH.'/icode.lms.lib.php');

        $port_setting = get_icode_port_type($config['cf_icode_id'], $config['cf_icode_pw']);

        // SMS 모듈 ?�래???�성
        if($port_setting !== false) {
            // ?��?글?� 질문 ?�록?�에�??�송
            if($w == 'a' && $write['qa_sms_recv'] && trim($write['qa_hp'])) {
                $sms_content = $config['cf_title'].' '.$qaconfig['qa_title'].'???��????�록?�었?�니??';
                $send_number = preg_replace('/[^0-9]/', '', $qaconfig['qa_send_number']);
                $recv_number = preg_replace('/[^0-9]/', '', $write['qa_hp']);

                if($recv_number) {
                    $strDest     = array();
                    $strDest[]   = $recv_number;
                    $strCallBack = $send_number;
                    $strCaller   = iconv_euckr(trim($config['cf_title']));
                    $strSubject  = '';
                    $strURL      = '';
                    $strData     = iconv_euckr($sms_content);
                    $strDate     = '';
                    $nCount      = count($strDest);

                    $SMS = new LMS;
                    $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $port_setting);
                    $res = $SMS->Add($strDest, $strCallBack, $strCaller, $strSubject, $strURL, $strData, $strDate, $nCount);

                    if($res) {
                        $SMS->Send();
                    }

                    $SMS->Init(); // 보�??�고 ?�던 결과값을 지?�니??
                }
            }

            // 문의글 ?�록??관리자?�게 ?�송
            if(($w == '' || $w == 'r') && trim($qaconfig['qa_admin_hp'])) {
                $sms_content = $config['cf_title'].' '.$qaconfig['qa_title'].'??문의글???�록?�었?�니??';
                $send_number = preg_replace('/[^0-9]/', '', $qaconfig['qa_send_number']);
                $recv_number = preg_replace('/[^0-9]/', '', $qaconfig['qa_admin_hp']);

                if($recv_number) {
                    $strDest     = array();
                    $strDest[]   = $recv_number;
                    $strCallBack = $send_number;
                    $strCaller   = iconv_euckr(trim($config['cf_title']));;
                    $strSubject  = '';
                    $strURL      = '';
                    $strData     = iconv_euckr($sms_content);
                    $strDate     = '';
                    $nCount      = count($strDest);

                    $SMS = new LMS;
                    $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $port_setting);
                    $res = $SMS->Add($strDest, $strCallBack, $strCaller, $strSubject, $strURL, $strData, $strDate, $nCount);

                    if($res) {
                        $SMS->Send();
                    }

                    $SMS->Init(); // 보�??�고 ?�던 결과값을 지?�니??
                }
            }
        }
    } else {
        include_once(G5_LIB_PATH.'/icode.sms.lib.php');

        // ?��?글?� 질문 ?�록?�에�??�송
        if($w == 'a' && $write['qa_sms_recv'] && trim($write['qa_hp'])) {
            $sms_content = $config['cf_title'].' '.$qaconfig['qa_title'].'???��????�록?�었?�니??';
            $send_number = preg_replace('/[^0-9]/', '', $qaconfig['qa_send_number']);
            $recv_number = preg_replace('/[^0-9]/', '', $write['qa_hp']);

            if($recv_number) {
                $SMS = new SMS; // SMS ?�결
                $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
                $SMS->Add($recv_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_content)), "");
                $SMS->Send();
            }
        }

        // 문의글 ?�록??관리자?�게 ?�송
        if(($w == '' || $w == 'r') && trim($qaconfig['qa_admin_hp'])) {
            $sms_content = $config['cf_title'].' '.$qaconfig['qa_title'].'??문의글???�록?�었?�니??';
            $send_number = preg_replace('/[^0-9]/', '', $qaconfig['qa_send_number']);
            $recv_number = preg_replace('/[^0-9]/', '', $qaconfig['qa_admin_hp']);

            if($recv_number) {
                $SMS = new SMS; // SMS ?�결
                $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
                $SMS->Add($recv_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_content)), "");
                $SMS->Send();
            }
        }
    }
}

// ?��? ?�메?�전??
if($w == 'a' && $write['qa_email_recv'] && trim($write['qa_email'])) {
    include_once(G5_LIB_PATH.'/mailer.lib.php');

    $subject = $config['cf_title'].' '.$qaconfig['qa_title'].' ?��? ?�림 메일';
    $content = nl2br(conv_unescape_nl(stripslashes($qa_content)));

    mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $write['qa_email'], $subject, $content, 1);
}

// 문의글?�록 ?�메?�전??
if(($w == '' || $w == 'r') && trim($qaconfig['qa_admin_email'])) {
    include_once(G5_LIB_PATH.'/mailer.lib.php');

    $subject = $config['cf_title'].' '.$qaconfig['qa_title'].' 질문 ?�림 메일';
    $content = nl2br(conv_unescape_nl(stripslashes($qa_content)));

    mailer($config['cf_admin_email_name'], $qa_email, $qaconfig['qa_admin_email'], $subject, $content, 1);
}

if($w == 'a')
    $result_url = G5_BBS_URL.'/qaview.php?qa_id='.$qa_id.$qstr;
else if($w == 'u' && $write['qa_type'])
    $result_url = G5_BBS_URL.'/qaview.php?qa_id='.$write['qa_parent'].$qstr;
else
    $result_url = G5_BBS_URL.'/qalist.php'.preg_replace('/^&amp;/', '?', $qstr);

if ($file_upload_msg)
    alert($file_upload_msg, $result_url);
else
    goto_url($result_url);
?>

