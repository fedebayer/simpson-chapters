{include file='templates/header.tpl'}

<div class="container">

    <div class="row mt-4">
        <div class="col-md-4">
            <h2>Register</h2>
            <form class="form-alta" action="signUpAction" method="post">
                <input placeholder="email" type="text" name="email" id="email" required>
                <input placeholder="password" type="password" name="password" id="password" required>
                <input placeholder="password" type="password" name="passwordConfirm" id="passwordConfirm" required>
                <input type="submit" class="btn btn-primary" value="Registrarse">
            </form>
        </div>
    </div>
    <h4 class="alert-danger">{$error}</h4>
</div>

{include file='templates/footer.tpl'}