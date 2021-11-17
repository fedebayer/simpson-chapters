{include file="templates/header.tpl"}
<h1>Informacion del director</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nombre</a></th>
            <th scope="col">Biografia</a></th>
        </tr>
    </thead>
    <tbody>
    {foreach from=$directors item=$director}
        <tr>
        <td>{$director->nombre_director}</td>
        <td>{$director->biografia}</td>
        </tr>
    {/foreach}
    </tbody>
</table>
<br>
<div class="btn btn-outline-primary"><a href="{BASE_URL}directores">Volver</a></div>
{include file="templates/footer.tpl"}