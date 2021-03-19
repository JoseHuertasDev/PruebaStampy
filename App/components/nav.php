<nav>
    <ul>
        <li><a href="home">Home</a></li>
        <?php if($isAuth == true){?>
            <li><a href="./logout">Salir</a></li>
        <?php } else {?> 
            <li><a href="./login">Iniciar</a></li>
        <?php } ?>
    </ul>
</nav>