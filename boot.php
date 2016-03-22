<?php
if (!rex::isBackend()) {

   if ($this->getConfig('scss_compiler_aktiv') == '1') {
    include_once('vendor/scss_compiler.php');
   }

}
