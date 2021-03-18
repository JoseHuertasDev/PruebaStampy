<?php 
    interface ITemplate{
        public function setFile($file);
        public function set($key, $variable);
        public function getOutput();
    }

    class TemplateEngine implements ITemplate{

        private $values;
        private $file;
        function __construct()
        {
            $this->values = (object) array();
        }
        public function setFile($file){
            $this->file = $file;
        }

        public function set($key, $variable){
            $this->values->$key = $variable;
        }

        public function getOutput() {
            if (!file_exists($this->file)) {
                throw new Exception("missing file '" . $this->file . "'.");
            }

            $html = file_get_contents($this->file);
        
            foreach ($this->values as $key => $value) {
                $tagToReplace = "{{{$key}}}";
                $html = str_replace($tagToReplace, $value, $html);
            }
        
            return $html;
        }
    }