{include file="templates/header.tpl"}
<h1>Directores de Simsonmania</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col"><a href="listDirectorsByCategory/nombre_director">Nombre</a></th>
                {if $idToChange != null}
                    <th scope="col">gag</a></th>
                {/if}
            </tr>
        </thead>
        {foreach from=$directors item=$director}
            {if $idToChange != null}
                {if $director->id_director === $idToChange}
                    <tr>
                        <form action="{BASE_URL}updateDirector/{$idToChange}" method="post">
                        <td><input type="text" name="nombre" id="nombre" value = "{$director->nombre_director}"></td>
                        <td><input type="text" name="biografia" id="biografia" value = "{$director->biografia}"></td>
                        <td><div><button type="submit" class="btn btn-outline-primary">Confirmar</button></div></td>
                        </form>
                    </tr>
                {/if}
                {else}
                    <tr>
                        <td>{$director->nombre_director}</td>
                            <td><a class="btn btn-outline-success" href="viewDirectorInfo/{$director->id_director}"> Info</a></td>
                        {if $logged}
                            <td><a class="btn btn-outline-danger" href="deleteDirector/{$director->id_director}"> Borrar</a></td>
                            <td><a class="btn btn-outline-info" href="goToUpdateDirector/{$director->id_director}"> Editar</a></td>
                        {/if}
                    </tr>
            {/if}
        {/foreach}
    </table>
    <br>
    <h2>Buscar Capitulos de Director</h2>
    <form action="searchDirectorChapters" method="post">
        <input type="text" name="directorABuscar" id="directorABuscar" placeholder="nombre de director">
        <input type="submit" class="btn btn-outline-primary" name="enviar" value="Buscar">
    </form>
    {if $logged}
        <br><br>
        <h1>Ingrese Director</h1>
        <form action="createDirector" method="post">
            <input type="text" name="nombre" id="nombre" placeholder="nombre">
            <textarea type="text" name="biografia" id="biografia" placeholder="biografia"></textarea>
            <input type="submit" class="btn btn-outline-primary" name="enviar">
        </form>
    {/if}
    <br><br>
    <a href="{BASE_URL}home" class="btn btn-outline-primary" name="enviar"/>Volver a Capitulos

{include file="templates/footer.tpl"}
