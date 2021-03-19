<?php
    interface IView
    {
        /**
         * @var string
         */
        function show($message = "");
    }

    class ViewBase{
        private $_authService;
        function __construct(IAuthService $authService){
            $this->_authService = $authService;
        }
        function showHeader(){
            $isAuth = $this->_authService->isAuth();
            include "./app/components/header.php";
        }
        function showFooter(){
            include "./app/components/footer.php";
        }
    }