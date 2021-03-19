<section class="form-container">
    <form action="log-user" class="loginform" method="post">
        <h4>Login </h4>
        <div class="input-container">
            <label for="user">Usuario </label>
            <input type="email" id="user" name="input_user">
        </div>
        <div class="input-container">
            <label for="password">Contraseña </label>
            <input type="password" id="password" name="input_pass">
        </div>
        <div class="input-container">
            <input type="submit" value="Iniciar">
        </div>
        <?php if($message !== ""){?>
            <p class="text-error"><?php echo $message ?></p>
        <?php }?>
    </form>
</section>