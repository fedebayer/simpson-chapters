{include file="templates/header.tpl"}
{if $fromDirectors!=0}
    <div class="btn btn-outline-primary"><a href="{BASE_URL}directores">Volver</a></div>
{/if}
{if $fromChapters!=0}
    <div class="btn btn-outline-primary"><a href="{BASE_URL}home">Volver</a></div>
{/if}
        <h1>Lista por director: {$director}</h1>
        <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</a></th>
                <th scope="col">Temporada</a></th>
                <th scope="col">Estreno</a></th>
                <th scope="col">Gag<a/></th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$chapters item=$chapter}
                <tr>
                    <td>{$chapter->nombre}</td>
                    <td>{$chapter->temporada}</td>
                    <td>{$chapter->estreno}</td>
                    <td>{$chapter->gag}</td>
                </tr>
            {/foreach}
        </tbody>
        </table>
{include file="templates/footer.tpl"}