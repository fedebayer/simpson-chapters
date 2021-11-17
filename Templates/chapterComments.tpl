<h1>Comentarios de Capitulo</h1>
    <ul id="commentsList" class="list-group">
    
    </ul>
        <br>
        {if $logged}
            <br><br>
            <h1>Ingrese Comentario</h1>
            <form action="createComment" method="post">
                <label for="">Comentario</label>
                <textarea type="text" name="comentario" id="comentario"></textarea>
                <label for="">Puntuacion</label>
                <input type="number" name="puntuacion" id="puntuacion" max="5" min="1">
                <input type="submit" class="btn btn-outline-primary" name="enviar">
            </form>
        {/if}
<script src="js/comments.js"></script>