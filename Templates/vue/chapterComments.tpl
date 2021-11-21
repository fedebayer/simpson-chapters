

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
    <ul id="commentsList" class="list-group">
        <li v-if="comentario.email" v-for="comentario in comentarios" class="list-group-item"><div>
        <h5>{{comentario.email}}</h5>
        <strong>Comentario:</strong> {{comentario.comentarios}} <strong> | Puntuacion:</strong> {{comentario.puntuacion}}<div></li>
    </ul>
{/literal}