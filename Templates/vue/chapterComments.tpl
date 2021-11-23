<div id="commentsList" class = "container">
    {if $rol!=0}
        <input type="hidden" data-rol="$user->rol" id ="getRol">
    {/if}
    <h1>Comentarios de Capitulo</h1>
    <form id="form-puntaje" data-filtro="puntaje">
    <label>Filtra por puntaje</label>
    <select id="valorPuntaje">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <input type="submit" class="btn btn-outline-primary" name="enviar">
</form>
{literal}
    <table class = "table">
        <thead>
            <th>Usuario</th>
            <th>Comentario</th>
            <th> <a v-on:click = "byScore()" id = "byScore" type = "" >Puntuacion</a></th>
            <th> <a v-on:click = "byDate()" id = "byDate" type = "" >Fecha</a></th>
            <th></th>
        </thead>
        <tr v-for="comentario in paginatedItems">
            <td> {{comentario.email}} </td>
            <td> {{comentario.comentarios}} </td>
            <td> {{comentario.puntuacion}} </td>
            <td> {{comentario.fecha}} </td>
            <td> <input v-bind:type = "isAdmin()" v-on:click = "deleteComment(comentario.id_comentario)" value = "Borrar"> </td>
        </tr>
    </table>
    <br>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-on:click = "getPreviousPage()" v-bind:class = "isPrevDisabled()" class="page-item"><a class="page-link">Anterior</a></li>
                <li v-on:click = "getPaginatedData(pagina)" v-for = "pagina in totalPages" v-bind:class = "isActive(pagina)" class="page-item"><a class="page-link">{{pagina}}</a></li>
                <li v-on:click = "getNextPage()" v-bind:class = "isNextDisabled()" class="page-item"><a class="page-link">Siguiente</a></li>
            </ul>
        </nav>
</div>
{/literal}