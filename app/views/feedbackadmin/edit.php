<br/>
<div class="add-form well">
    <a href="/administrator" class="btn btn-default">Назад</a>
    <strong>Форма добавления отзыва</strong>
    <?php if(!empty($this->messages)): ?>
        <div class="well warning">
            <div><strong>Ошибки валидации формы</strong> <br/></div>
            <div><br/></div>
            <ul>
                <?php foreach($this->messages as $m): ?>
                    <li><sup class="form-group"><?php echo $m ?></sup></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>
    <div><br/></div>
    <form class="well" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="<?php echo $this->item['email'] ?>">
        </div>
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" placeholder="Имя" name="name" value="<?php echo $this->item['name'] ?>">
        </div>
        <div class="form-group">
            <label for="message">Сообщение</label>
            <textarea type="text" class="form-control" id="message" placeholder="Сообщение" name="message"
            ><?php echo $this->item['message'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-default">Обновить</button>
    </form>
</div>

