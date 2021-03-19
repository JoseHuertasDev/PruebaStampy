<?php
    //Libs
    include_once "libs/dependency.injector.php";
    include_once "libs/router.class.php";

    //Controllers
    include_once "./app/controller/base.controller.php";
    include_once "./app/controller/home.controller.php";
    include_once "./app/controller/user.controller.php";

    //Views
    include_once "./app/view/view.base.php";
    include_once "./app/view/home.view.php";
    include_once "./app/view/user.view.php";

    //Models
    include_once "./app/model/user.model.php";

    //Services
    include_once "./app/services/auth.service.php";
    include_once "./app/services/navigation.service.php";
