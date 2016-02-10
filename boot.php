<?php
if (!rex::isBackend()) {

   if ($this->getConfig('scss_compiler_aktiv') == 'ja') {
    include_once('vendor/scss_compiler.php');
   }

}
