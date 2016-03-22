<?php

require_once __DIR__ . '/scssphp/scss.inc.php';

class scss_compiler
{
    protected $root_dir;
    protected $scss_file;
    protected $css_file;
    protected $formatter;
    protected $strip_comments;



    public function __construct()
    {
        $this->root_dir =   './assets/';
        $this->scss_file =  './assets/scss/styles.scss';
        $this->css_file =   './assets/css/styles.min.css';
        $this->formatter =  'scss_formatter_compressed';
        $this->strip_comments = true;
    }


    public function setRootDir($value)
    {
        $this->root_dir = $value;
    }


    public function setScssFile($value)
    {
        $this->scss_file = $value;
    }


    public function setCssFile($value)
    {
        $this->css_file = $value;
    }

    /*
     * @param string $value scss_formatter (default) or scss_formatter_nested or scss_formatter_compressed
    */
    public function setFormatter($value)
    {
        $this->formatter = $value;
    }


    public function setStripComments($value = true)
    {
        $this->strip_comments = $value;
    }

    /*
     * @param string $scss_folder source folder where you have your .scss files
     * @param string $scss_global_file
     * @param string $format_style CSS output format
     * @param bool $strip_comments
     */
    public function compile()
    {
        // go on even if user "stops" the script by closing the browser, closing the terminal etc.
        ignore_user_abort(true);
        // set script running time to unlimited
        set_time_limit(0);

        $root_dir = $this->root_dir;

        $scss_compiler = new scssc();
        $scss_compiler->setNumberPrecision(10);
        $scss_compiler->stripComments = $this->strip_comments;

        $scss_compiler->addImportPath(function ($path) use ($root_dir) {

            $path_scss  = $root_dir . $path . '.scss';
            $path_css   = $root_dir . $path . '.css';
            $path_parts = pathinfo($path_scss);

            $underscore_file = $path_parts['dirname'] . '/_' . $path_parts['basename'];
            if (file_exists($underscore_file)) {
                $path = $underscore_file;
            } else {
                $path = $path_scss;
            }

            if (file_exists($path_css)) {
                $path = $path_css;
            }

            if (! file_exists($path)) {
                return null;
            }


            return $path;

        });
        // set the path to your to-be-imported mixins. please note: custom paths are coming up on future releases!
        //$scss_compiler->setImportPaths($scss_folder);

        // set css formatting (normal, nested or minimized), @see http://leafo.net/scssphp/docs/#output_formatting
        $scss_compiler->setFormatter($this->formatter);

        // get .scss's content, put it into $string_sass
        $string_sass = file_get_contents($this->scss_file);

        // try/catch block to prevent script stopping when scss compiler throws an error
        try {
            // compile this SASS code to CSS
            $string_css = $scss_compiler->compile($string_sass);

            // $string_css = csscrush_string($string_css, $options = array('minify' => true));

            // write CSS into file with the same filename, but .css extension
            file_put_contents($this->css_file, $string_css);


        } catch (Exception $e) {
            // here we could put the exception message, but who cares ...
            echo $e->getMessage();
            exit();
        }
    }
}



$compiler = new scss_compiler();
$compiler->setScssFile('./assets/scss/print.scss');
$compiler->setCssFile('./assets/css/print.min.css');
//$compiler->setFormatter('scss_formatter');
$compiler->setFormatter('scss_formatter_compressed');
$compiler->compile();


$compiler = new scss_compiler();
//$compiler->setFormatter('scss_formatter');
$compiler->setFormatter('scss_formatter_compressed');
$compiler->compile();
