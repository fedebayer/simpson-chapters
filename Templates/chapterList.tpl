{include file="templates/header.tpl"}
<h1>Capitulos de Simsonmania</h1>
<h3>Buscador</h3>
<form action="{BASE_URL}searchChapters" method="post">
    <input type="text" name="nombre" placeholder="nombre">
    <input type="text" name="temporada" placeholder="temporada">
    <label for="estreno">Estreno:</label>
    <input type="date" name="estreno">
    <input type="text" name="director" placeholder="director">
    <input type="text" name="guionista" placeholder="guionista">
    <button type="submit" class="btn btn-outline-primary">Buscar</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th scope="col"><a href="{BASE_URL}listByCategory/nombre">Nombre</a></th>
            <th scope="col"><a href="{BASE_URL}listByCategory/temporada">Temporada</a></th>
            <th scope="col"><a href="{BASE_URL}listByCategory/estreno">Estreno</a></th>
            {if $idToChange != 0}<th><a href="{BASE_URL}listByCategory/gag">Gag<a/></th>{/if}
            <th><a href="{BASE_URL}listByCategory/nombre_director">Director</a></th>
            {if $idToChange != 0}<th><a href="listByCategory/imagen">Imagen<a/></th>{/if}
            <th><a href="{BASE_URL}listByCategory/guionistas">Guionista(s)</a></th>
        </tr>
    </thead>
    {foreach from=$chapters item=$chapter}
            {if $idToChange != null}
                {if $chapter->id_capitulo === $idToChange}
                    <tr>
                        <form action="{BASE_URL}updateChapter/{$idToChange} "method="post" enctype ="multipart/form-data">
                            <td><input type="text" name="nombre" id="nombre" value = "{$chapter->nombre}"></td>
                            <td><input type="text" name="temporada" id="temporada" value = "{$chapter->temporada}"></td>
                            <td><input type="text" name="estreno" id="estreno" value = "{$chapter->estreno}"></td>
                            <td><input type="text" name="gag" id="gag" value = "{$chapter->gag}"></td>
                            <td><select name="id_director">
                            <option value="{$chapter->id_director}">{$chapter->director}</option>
                            {foreach from=$directors item=$director}
                            <option value="{$director->id_director}">{$director->nombre_director}</option>
                            {/foreach}
                            </select></td>
                            <td><input type="file" name="input_name" id="imageToUpload"></td>
                            <td>
                            {foreach from=$screenwriters item=$screenwriter}
                                <input type="checkbox" name = "screenwriters[]" value="{$screenwriter->id_guionista}">{$screenwriter->nombre}
                            {/foreach}
                            </td>
                            <td><button type="submit" class="btn btn-outline-primary">Confirmar</button></td>
                        </form>
                    </tr>
                {/if}
                {else}
                <tr>
                    <td>{$chapter->nombre}</td>
                    <td>{$chapter->temporada}</td>
                    <td>{$chapter->estreno}</td>
                    <td>{$chapter->director}</td>
                    <td>{$chapter->guionistas}</td>
                    <td><a class="btn btn-outline-success" href="viewChapterInfo/{$chapter->id_capitulo}/{$chapter->director}"> Info</a></td>
                    {if $logged}
                        <td><a class="btn btn-outline-danger" href="deleteChapter/{$chapter->id_capitulo}"> Borrar</a></td>
                        <td><a class="btn btn-outline-info" href="goToUpdateChapter/{$page}/{$chapter->id_capitulo}"> Editar</a></td>
                    {/if}
                </tr>
            {/if}
    {/foreach}
    </table>
    <br>
        <nav>
            <ul class = "pagination pagination-mg">
                {if $page == 1} <li class = "page-item disabled"><a class = "page-link" href = 'home'>Anterior</a></li>
                {else} <li class = "page-item"><a class = "page-link" href = 'home/{$page-1}'>Anterior</a></li>
                {/if}
                {for $i = 1 to $pages}
                    {if $i != $page}
                        <li class = "page-item"><a class = "page-link" href = 'home/{$i}'>{$i}</a></li>
                        {else} <li class = "page-item active"><a class = "page-link">{$i}</a></li> 
                    {/if}
                {/for}
                {if $page == $pages} <li class = "page-item disabled"><a class = "page-link" href = 'home'>Siguiente</a></li>
                {else} <li class = "page-item"><a class = "page-link" href = 'home/{$page+1}'>Siguiente</a></li>
                {/if}
                
            </ul>
        </nav>
        <br>
        <h2>Buscar Capitulos de Director</h2>
        <form action="searchChaptersOfDirector" method="post">
            <input type="text" name="directorABuscar" id="directorABuscar" placeholder="nombre de director">
            <input type="submit" class="btn btn-outline-primary" name="enviar" value="Buscar">
        </form>
        {if $logged}
            <br><br>
            <h1>Ingrese Capitulo</h1>
            <form action="createChapter" method="post" enctype ="multipart/form-data">
                <input type="text" name="nombre" id="nombre" placeholder="nombre">
                <input type="text" name="temporada" id="temporada" placeholder="temporada">
                <label for="estreno">Fecha de estreno:</label>
                <input type="date" name="estreno" id="estreno" placeholder="estreno">
                <textarea type="text" name="gag" id="gag" placeholder="gag"></textarea>
                <label for="id_director">Director:</label>
                <select name="id_director">
                {foreach from=$directors item=$director}
                    <option value="{$director->id_director}">{$director->nombre_director}</option>
                {/foreach}
                </select>
                <label for="imageToUpload">Imagen:</label>
                <input type="file" name="input_name" id="imageToUpload">
                <br>
                <label>Guionista/s:</label>
                {foreach from=$screenwriters item=$screenwriter}
                    {if $screenwriter->id_guionista != ''}
                        <input type="checkbox" name = "screenwriters[]" value="{$screenwriter->id_guionista}">{$screenwriter->nombre}
                    {/if}
                {/foreach}
                <input type="submit" class="btn btn-outline-primary" name="enviar">
            </form>
        {/if}
        <br><br>
        <a href="directores" class="btn btn-outline-primary" name="enviar"/>Ir a Directores
        <a href="guionistas" class="btn btn-outline-primary" name="enviar"/>Ir a Guionistas
        {if !$logged}
            <a href="login" class="btn btn-outline-primary" name="enviar"/>Iniciar sesion
        {/if}
        {if $rol != 0}
            <a href="usuarios" class="btn btn-outline-primary" name="enviar"/>Usuarios
        {/if}
        {if !$logged}
            <a href="signUp" class="btn btn-outline-primary" name="enviar"/>Registrarse
        {/if}
        {if $logged}
            <a href="logout" class="btn btn-outline-danger" name="enviar"/>Cerrar sesion
        {/if}
{include file="templates/footer.tpl"}