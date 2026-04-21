<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function editor_html($id, $content, $is_dhtml_editor=true)
{
    global $g5, $config, $w, $board, $write;
    static $js = true;

    if(
        $is_dhtml_editor && $content &&
        (
        (!$w && (isset($board['bo_insert_content']) && !empty($board['bo_insert_content'])))
        || ($w == 'u' && isset($write['wr_option']) && strpos($write['wr_option'], 'html') === false )
        )
    ){
        if( preg_match('/\r|\n/', $content) && $content === strip_tags($content, '<a><strong><b>') ) {
            $content = nl2br($content);
        }
    }

    $html = "";
    $html .= "<span class=\"sound_only\">웹에디터 시작</span>";

    if ($is_dhtml_editor && $js) {
        $html .= "\n".'<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">';
        $html .= "\n".'<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>';
        $html .= "\n".'<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ko-KR.min.js"></script>';
        $js = false;
    }

    $smarteditor_class = $is_dhtml_editor ? "smarteditor2" : "";
    $html .= "\n<textarea id=\"$id\" name=\"$id\" class=\"$smarteditor_class\" maxlength=\"65536\" style=\"width:100%;height:300px\">$content</textarea>";

    if ($is_dhtml_editor) {
        $html .= "\n<script>";
        $html .= "\n$(function() {";
        $html .= "\n    $('#{$id}').summernote({";
        $html .= "\n        lang: 'ko-KR',";
        $html .= "\n        height: 300,";
        $html .= "\n        toolbar: [";
        $html .= "\n            ['style', ['style']],";
        $html .= "\n            ['font', ['bold', 'underline', 'clear']],";
        $html .= "\n            ['color', ['color']],";
        $html .= "\n            ['para', ['ul', 'ol', 'paragraph']],";
        $html .= "\n            ['table', ['table']],";
        $html .= "\n            ['insert', ['link', 'picture', 'video']],";
        $html .= "\n            ['view', ['fullscreen', 'codeview', 'help']]";
        $html .= "\n        ],";
        $html .= "\n        callbacks: {";
        $html .= "\n            onImageUpload: function(files) {";
        $html .= "\n                var data = new FormData();";
        $html .= "\n                data.append('file', files[0]);";
        $html .= "\n                $.ajax({";
        $html .= "\n                    data: data,";
        $html .= "\n                    type: 'POST',";
        $html .= "\n                    url: '" . G5_EDITOR_URL . "/summernote/upload.php',";
        $html .= "\n                    cache: false,";
        $html .= "\n                    contentType: false,";
        $html .= "\n                    processData: false,";
        $html .= "\n                    success: function(url) {";
        $html .= "\n                        $('#{$id}').summernote('insertImage', url);";
        $html .= "\n                    },";
        $html .= "\n                    error: function(jqXHR, textStatus, errorThrown) {";
        $html .= "\n                        alert('이미지 업로드 실패: ' + jqXHR.responseText);";
        $html .= "\n                    }";
        $html .= "\n                });";
        $html .= "\n            }";
        $html .= "\n        }";
        $html .= "\n    });";
        $html .= "\n});";
        $html .= "\n</script>";
    }
    
    $html .= "\n<span class=\"sound_only\">웹 에디터 끝</span>";
    return $html;
}

function editor_js($id)
{
    return "var {$id}_editor_data = $('#{$id}').summernote('code');";
}

function get_editor_js($id, $is_dhtml_editor=true)
{
    if ($is_dhtml_editor) {
        return "document.getElementById('{$id}').value = $('#{$id}').summernote('code');\nvar {$id}_editor = document.getElementById('{$id}');\nif ({$id}_editor.value == '<p><br></p>') {$id}_editor.value = '';\n";
    } else {
        return "var {$id}_editor = document.getElementById('{$id}');\n";
    }
}

function chk_editor_js($id, $is_dhtml_editor=true)
{
    if ($is_dhtml_editor) {
        return "if(!document.getElementById('{$id}').value || document.getElementById('{$id}').value == '<p><br></p>') { alert(\"내용을 입력해 주십시오.\"); $('#{$id}').summernote('focus'); return false; }\n";
    } else {
        return "if (!document.getElementById('{$id}').value) { alert(\"내용을 입력해 주십시오.\"); document.getElementById('{$id}').focus(); return false; }\n";
    }
}
?>
