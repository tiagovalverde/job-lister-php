<?php 
class Template {
    // Path to the template
    protected $template;
    // vars passed in
    protected $vars = array();

    // Constructor
    public function __construct($template) {
        $this->template = $template;
    }

    public function __get($key) {
        return $this->vars[$key];
    }

    public function __set($key, $value) {
        $this->vars[$key] = $value;
    }

    public function __toString() {
       try {
           extract($this->vars);
           chdir(dirname($this->template));
           
           // buffer
           ob_start();
           include basename($this->template);
           return ob_get_clean();
       } catch(Exception $e) {
           var_dump($exception->getMessage());
       }
    }
}