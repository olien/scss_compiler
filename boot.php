<?php
if (!rex::isBackend()) {
   if ($this->getConfig('scss_compiler_aktiv') == '1') {
        $compiler = new rex_scss_compiler();
        $compiler->setScssFile('./assets/scss/styles.scss');
        $compiler->setCssFile('./assets/css/styles.min.css');
        $compiler->setScssFile('./assets/scss/print.scss');
        $compiler->setCssFile('./assets/css/print.min.css');
        $compiler->compile();
   }
}