<?php
    class HomeView extends ViewBase implements IView {
        public function show($message = ""){
            $this->showHeader();
            include('./app/components/home.php');
            $this->showFooter();
        }
    }