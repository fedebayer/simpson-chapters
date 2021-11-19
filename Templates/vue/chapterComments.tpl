
{literal}
<h1>Comentarios de Capitulo</h1>
    <ul id="commentsList" class="list-group">
        <li v-if="comentario.email" v-for="comentario in comentarios" class="list-group-item"><div>
        <h5>{{comentario.email}}</h5>
        <strong>Comentario:</strong> {{comentario.comentarios}} <strong> | Puntuacion:</strong> {{comentario.puntuacion}}<div></li>
    </ul>
{/literal}