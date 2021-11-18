{include file="templates/header.tpl"}
<h1>Lista de usuarios</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Email</a></th>
            <th scope="col">Rol</a></th>
            <th scope="col">Opciones</a></th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$users item=$user}
            <tr>
                <td>{$user->email}</td>
                {if $user->rol == 1}
                    <td>Administrador root</td>
                {/if}
                {if $user->rol == 0}
                    <td>Usuario</td>
                    <td><a class="btn btn-outline-danger" href="usuarios/deleteUser/{$user->id_usuario}"> Borrar</a>
                    <a class="btn btn-outline-info" href="usuarios/updateUser/{$user->id_usuario}"> Dar permisos</a></td>
                    
                {/if}
                {if $user->rol == 2}
                    <td>Administrador</td>
                    
                    {if $idUser != $user->email}
                        <td><a class="btn btn-outline-danger" href="usuarios/deleteUser/{$user->id_usuario}"> Borrar</a>
                        <a class="btn btn-outline-danger" href="usuarios/updateUser/{$user->id_usuario}"> Quitar permisos</a></td>
                    {/if}
                {/if}
            </tr>
        {/foreach}
    </tbody>
    
</table>
        
{include file="templates/footer.tpl"}