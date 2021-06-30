<main class="form-signin">
    <form action="/signup" method="post">
        <h1 class="h3 mb-3 fw-normal">Sign Up form</h1>
        <label for="inputName" class="visually-hidden">Account Name</label>
        <input name="name" type="name" id="inputName" class="form-control"
               placeholder="Name" value="<?=$data['value']['name']?>" required autofocus>
        <div class="alert alert-danger fade show" role="alert"
            <?=isset($data['error']['name'])?'':'hidden'?>><?=$data['error']['name']?>
        </div>
        <label for="inputEmail" class="visually-hidden">Email address</label>
        <input name="email" type="email" id="inputEmail" class="form-control"
               placeholder="Email address" value="<?=$data['value']['email']?>" required>
        <div class="alert alert-danger fade show" role="alert"
            <?=isset($data['error']['email'])?'':'hidden'?>><?=$data['error']['email']?>
        </div>
        <label for="inputPassword" class="visually-hidden">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control"
               placeholder="Password" value="" required>
        <label for="inputPasswordConfirm" class="visually-hidden">Confirm Password</label>
        <input name="confirmPassword" type="password" id="inputPasswordConfirm" class="form-control"
               placeholder="Confirm Password" value="" required>
        <div class="alert alert-danger fade show" role="alert"
            <?=isset($data['error']['password'])?'':'hidden'?>><?=$data['error']['password']?>
        </div>
        <div class="checkbox mb-3">
            <label>
                <input name="terms" type="checkbox" value="true" required> I accept <a href="/tos">Terms of Service</a>
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
    </form>
</main>
