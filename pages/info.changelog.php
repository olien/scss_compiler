<?php

 $file = rex_file::get(rex_path::addon('scss_compiler','CHANGELOG.md'));
 $Parsedown = new Parsedown();

 $content =  $Parsedown->text($file);

$fragment = new rex_fragment();
$fragment->setVar('title', 'Changelog');
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');


