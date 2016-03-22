<?php

$content = '';


if (rex_post('config-submit', 'boolean')) {
    $this->setConfig(rex_post('config', [
        ['scss_compiler_aktiv', 'string'],
    ]));

    $content .= rex_view::info('Änderung gespeichert');
}

$content .= '
<form action="'.rex_url::currentBackendPage().'" method="post" id="scss_compiler_setting">
    <div class="container-fluid">
        <div class="col-xs-6">
            <input class="rex-form-text" type="checkbox" id="rex-form-scss_compiler_aktiv" name="config[scss_compiler_aktiv]" value="1" ';

if($this->getConfig('scss_compiler_aktiv')=="1") $content .= 'checked="checked"';

$content .= ' />
            <label for="rex-form-scss_compiler_aktiv">'.$this->i18n("scss_compiler_aktiv").'</label>
        </div>
        <div class="col-xs-6 ">
            <button class="btn btn-save" type="submit" name="config-submit" value="1" title="'.$this->i18n('com_auth_config_save').'">'.$this->i18n('scss_compiler_save').'</button>
        </div>
    </div>
    </form>
';

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit');
$fragment->setVar('title', $this->i18n('scss_compiler_setting'));
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');


$content2 = '
<p>Der Compiler benötigt folgende Ordner:</p>

<code>./assets/scss/</code><br/>
<code>./assets/css/</code><br/><br/>

<p>Im <code>./assets/scss/</code> Ordner werden die Dateien <code>styles.scss</code> und <code>print.scss</code> erwartet die dann zu <code>styles.min.css</code> und <code>print.min.css</code> kompiliert und in den Ordner <code>./assets/css/</code> gespeichert werden.</p>
';

$fragment = new rex_fragment();
$fragment->setVar('title', $this->i18n('scss_compiler_erklaerung_title'));
$fragment->setVar('body', $content2, false);
echo $fragment->parse('core/page/section.php');





?>
<style>
#scss_compiler_setting label {
    font-weight: normal;
}

#scss_compiler_setting input[type=checkbox] {
    display: none;
}

#scss_compiler_setting input[type=checkbox] + label:before {
    font-family: FontAwesome;
    font-size: 20px;
    width: 30px;
    text-align: center;
    border-radius: 3px;
    background: #E9ECF2;
    border: 1px solid #c3c9d4;
    display: inline-block;
    margin-right: 10px;
}

#scss_compiler_setting input[type=checkbox] + label:before {
    padding-left: 2px;
    color: #c3c9d4;
    content: "\f00d";
}

#scss_compiler_setting input[type=checkbox] + label:before {
}

#scss_compiler_setting input[type=checkbox]:checked + label:before {
    padding-left: 2px;
    color: #3CB594;
    content: "\f00c";
}

#scss_compiler_setting input[type=checkbox]:checked + label:before {
}
</style>


