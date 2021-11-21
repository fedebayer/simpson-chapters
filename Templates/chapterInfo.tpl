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
            <input id="id_capitulo" value="{$chapter->id_capitulo}" type="hidden"></input>
            <td>{$chapter->nombre}</td>
            <td>{$chapter->temporada}</td>
            <td>{$chapter->estreno}</td>
            <td>{$chapter->gag}</td>
            <td>{$chapter->guionistas}</td>
            <td>{$director}</td>
            </tr>
            {if isset($chapter->imagen)}
                <td><img src="{$chapter->imagen}" width="300" height="300"/></td>
            {/if}
        {/foreach}
        </tbody>
        </table>
        <br>
        <div class="btn btn-outline-primary"><a href="{BASE_URL}home">Volver</a></div>
{if $logged}
            <br><br>
            <h1>Ingrese Comentario</h1>
            <form id="form-comment" data-idCapitulo = "{$chapter->id_capitulo}" data-idUsuario = "{$idUser}">
                <label for="">Comentario</label>
                <textarea type="text" name="comentarios" id="comentarios"></textarea>
                <label for="">Puntuacion</label>
                <input type="number" name="puntuacion" id="puntuacion" max="5" min="1">
                <input type="submit" class="btn btn-outline-primary" name="enviar">
            </form>
{/if}
    <br><br>
        {include file="Templates/vue/chapterComments.tpl"}
        <br>
<script src="js/comments.js"></script>
{include file="templates/footer.tpl"}