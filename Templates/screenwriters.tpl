{include file="templates/header.tpl"}
<div class = "container">
    <h1>Simpsonmania</h1>
    {if $logged}
        <div>
            <form action = "addScreenwriter" method = "POST">
                <input type="text" id = "nameScreenwriter" name = "nameScreenwriter" placeholder = "Guionista">
                <input type="submit" <a class="btn btn-outline-info" id = "btnSave" value = "Agregar guionista">
            </form>
            <label id="label"></label>
        </div>
    {/if}


    <table id = "tableScreenwriter" class = "tableScreenwriter">
        <tr>
            <th><a href="listByCategory/nombre">Guionistas</a></th>
        </tr>
        {foreach $screenwriters as $screenwriter}
            {if $idToChange != 0}
                {if $screenwriter->id_guionista === $idToChange}
                    <tr>
                        <form action="{BASE_URL}editScreenwritter/{$idToChange}" method="post">
                        <td><input type="text" name="nombreNuevo" id="nombreNuevo" value = "{$screenwriter->nombre}"></td>
                        <td><div><button type="submit" class="btn btn-outline-primary">Confirmar</button></div></td>
                        </form>
                    </tr>
                {/if}
                {else}
                    <tr>
                        <td>{$screenwriter->nombre}</td>
                        {if $logged}
                            <td><a class="btn btn-outline-danger" href="deleteScreenwriter/{$screenwriter->id_guionista}"> Borrar</a></td>
                            <td><a class="btn btn-outline-info" href="goToUpdateScreenwriter/{$screenwriter->id_guionista}"> Editar</a></td>
                        {/if}
                    </tr>
            {/if}
        {/foreach}
    </table>

    <select id="screenwriters" name="screenwriters">
        <option> </option>
        {foreach $screenwriters as $screenwriter}
            <option data-entry = "{$screenwriter->id_guionista}"> {$screenwriter->nombre} </option>;
        {/foreach}
    </select>

    <table id = "chaptersOfScreenwriter" class = "chaptersOfScreenwriter">
        <thead>
            <tr>
                <th>Capitulo</th>
                <th>Temporada</th>
            </tr>
        </thead>

        </tbody>
    </table>
    <br>
    <br>
    <a href="{BASE_URL}home" class="btn btn-outline-primary" name="enviar"/>Volver a Capitulos

    {include file="templates/footer.tpl"}
</div>