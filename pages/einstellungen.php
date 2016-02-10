<?php

$code =
'$this->root_dir = __DIR__ . "/../assets/";
$this->scss_file = __DIR__ . "/../assets/scss/styles.scss";
$this->css_file = __DIR__ . "/../assets/css/styles.min.css";
$this->formatter = "scss_formatter_compressed";
$this->strip_comments = true;

<link rel="stylesheet" href="/assets/css/styles.min.css" type="text/css" media="screen,print" />
<link rel="stylesheet" href="/assets/css/print.min.css" type="text/css" media="print" />';

 $content =  '';

 $content .= rex_string::highlight($code);

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit');
$fragment->setVar('title', 'Einstellungen');
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');


