<?php

$file = rex_file::get(rex_path::addon('scss_compiler','license.md'));
$Parsedown = new Parsedown();
$content =  $Parsedown->text($file);


$fragment = new rex_fragment();
$fragment->setVar('title', $this->i18n('license'), false);
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');
