<?php
require_once 'core/init.php';
$translate = Profil::Translate($_SESSION['City']);
Profil::EditProfilConfirm();