<?php
    class HomeView extends ViewBase implements IView {
        
        public function show($message = ""){
            $this->showHeader();
            echo "<h1>hello home</h1>";
            $this->showFooter();
        }
    }