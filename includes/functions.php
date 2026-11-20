<?php
if (session_status() === PHP_SESSION_NONE) session_start();
function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function redirect($url) { header("Location: $url"); exit; }
function flash($msg, $type='success') { $_SESSION['flash'] = ['msg'=>$msg, 'type'=>$type]; }
function show_flash() {
    if (!empty($_SESSION['flash'])) {
        $f=$_SESSION['flash']; unset($_SESSION['flash']);
        echo '<div class="alert '.e($f['type']).'">'.e($f['msg']).'</div>';
    }
}
