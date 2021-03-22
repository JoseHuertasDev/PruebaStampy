<section class="form-container">
    <?php if(isset($user->id) && $user !== false){ ?>
        <form action="guardar-usuario/<?php echo $user->id; ?>" class="loginform" method="post">
    <?php } else {?> 
        <form action="guardar-usuario" class="loginform" method="post">
    <?php } ?>
    <form action="save-user" class="loginform" method="post">
        <h4>Editar </h4>
        <div class="input-container">
            <label for="user">Usuario </label>
            <?php if(isset($user) && $user !== false ){ ?>
                <input type="email" id="user" name="input_user" value="<?php echo $user->email; ?>">
            <?php } else {?> 
                <input type="email" id="user" name="input_user">
            <?php } ?>
        </div>
        <div class="input-container">
            <label for="password">Contraseña </label>
            <input type="password" id="password" name="input_pass">
        </div>
        <div class="input-container">
            <label for="password_repeat">Repetir contraseña </label>
            <input type="password" id="password_repeat" name="input_pass_repeat">
        </div>
        <div class="input-container">
            <input type="submit" value="Guardar">
        </div>
        <?php if($message !== ""){?>
            <p class="text-error"><?php echo $message ?></p>
        <?php }?>
    </form>
</section>