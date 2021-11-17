{include file="templates/header.tpl"}
<h1>Informacion del capitulo</h1>
        <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</a></th>
                <th scope="col">Temporada</a></th>
                <th scope="col">Estreno</a></th>
                <th scope="col">Gag<a/></th>
                <th scope="col">Guionista(s)</a></th>
                <th scope="col">Director</a></th>
            </tr>
        </thead>
        <tbody>
        {foreach from=$chapters item=$chapter}
            <tr>
            <td>{$chapter->nombre}</td>
            <td>{$chapter->temporada}</td>
            <td>{$chapter->estreno}</td>
            <td>{$chapter->gag}</td>
            <td>{$chapter->guionistas}</td>
            <td>{$director}</td>
            </tr>
        {/foreach}
        </tbody>
        </table>
        <br>
        <div class="btn btn-outline-primary"><a href="{BASE_URL}home">Volver</a></div>
{include file="templates/chapterComments.tpl"}
{include file="templates/footer.tpl"}