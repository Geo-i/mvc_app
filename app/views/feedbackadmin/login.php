<br/>
<div class="add-form well">
    <strong>Форма авторизации</strong>
    <?php if(!empty($this->messages)): ?>
        <div class="well warning">
            <div><strong>Неверный логин или пароль</strong> <br/></div>
        </div>
    <?php endif ?>
    <div><br/></div>
    <form class="well" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input type="text" class="form-control" id="login" placeholder="login" name="login">
        </div>
        <div class="form-group">
            <label for="name">Пароль</label>
            <input type="password" class="form-control" id="password" placeholder="password" name="password">
        </div>
        <button type="submit" class="btn btn-default">Войти</button>
    </form>
</div>
<a href="/">На сайт</a>

