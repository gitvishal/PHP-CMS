<?php 
date_default_timezone_set("UTC");
define("SJ_NOW",(new DateTime("now"))->format("Y-m-d H:i:s"));
define("DB_HOST", "localhost");
define("DB_USER", "cms_user");
define("DB_PASS", "sjcms123");
define("DB_NAME", "CMS");
define("DRAFT", "DRAFT");
define("NEW_PAGE", "NEW");
define("RANK_1", "1");
define("RANK_2", "2");
define("RANK_3", "3");
define("TEMPLATE_DIR","../template/");
define("SJ_TEMPLATE",TEMPLATE_DIR ."sj-innovation-cms.php");
?>