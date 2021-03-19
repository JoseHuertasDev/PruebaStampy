<section>
   <h1>
        Lista de usuarios 
   </h1>
   <div class="create-user">
        <a href="create-user" >
            <button class="add-user">Añadir usuario</button>
        </a>
   </div>
    <table class="user-list">
        <thead>
            <tr>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($users)){
                    foreach($users as $user){
                        ?>
                            <tr>
                                <td>
                                    <?php echo $user->email?>
                                </td>
                                <td>
                                    <a href="eliminar-usuario/<?php echo $user->id?>">Eliminar</a>
                                    <a href="editar-usuario/<?php echo $user->id?>">Editar</a>
                                </td>
                            </tr>
                        <?php
                    }
                }
            ?>
            
        </tbody>
    </table>
</section>