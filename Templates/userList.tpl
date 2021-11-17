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
                    <td><a class="btn btn-outline-danger" href="deleteUser/{$user->id}"> Borrar</a>
                    <a class="btn btn-outline-info" href="updateUser/{$user->id}"> Dar permisos</a></td>
                {/if}
                {if $user->rol == 2}
                    <td>Administrador</td>
                    <td><a class="btn btn-outline-danger" href="deleteUser/{$user->id}"> Borrar</a>
                    <a class="btn btn-outline-danger" href="updateUser/{$user->id}"> Quitar permisos</a></td>
                {/if}
            </tr>
        {/foreach}
    </tbody>
    
</table>
        
{include file="templates/footer.tpl"}