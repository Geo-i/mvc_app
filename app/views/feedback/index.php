<header>
    <div class="page-header">  <a class="btn btn-default pull-right
        <?php if(!empty($admin)): ?>active<?php endif ?>" href="/administrator" >Администрировать</a>
        <h1><?php echo $this->title ?></h1> <br/>
        <div class="small">Форма обратной связи с пре-модерацией на чистом PHP, MySQL, Twitter Bootstrap и js для предпросмотра сообщения</div>
    </div>
</header>

<div class="feedbacks">
    <div class="controls">
        Сортировка:
        <a class="btn btn-default <?php if($this->field == 'name'): ?>active<?php endif ?>"
           href="/feedback?field=name&order=<?php echo $this->order; ?>"
        >По Имени</a>
        <a class="btn btn-default <?php if($this->field == 'created_at'): ?>active<?php endif ?>"
           href="/feedback?field=created_at&order=<?php echo $this->order; ?>"
        >По Дате</a>
        <a class="btn btn-default <?php if($this->field == 'email'): ?>active<?php endif ?>"
           href="/feedback?field=email&order=<?php echo $this->order; ?>"
        >По Email</a>
    </div>
    <br/>

    <?php if(!empty($this->added_successfully)): ?>
        <div class="well success">
            <div><strong>Сообщение успешно добавлено и появится после проверки модератором</strong> <br/></div>
            <div><br/></div>
        </div>
    <?php endif ?>

    <?php if($this->all_items) : ?>
    <?php foreach($this->all_items as $item): ?>
        <section class="well row">
            <span class="col-md-2">
                <?php if($item['image']):
                ?><img src="/avatars/<?php echo $item['id'] ?>.jpg" width="100" height="70"><?php
            else :
                ?><img src="http://placehold.it/100x70">
                <?php endif ?>
            </span>
            <span class="pull-left">Имя:&nbsp; </span> <h3 class=""> <?php echo $item['name']; ?> &nbsp; Email: <?php echo $item['email']; ?></h3>
            <hr/>
            Сообщение: <span> <?php echo $item['message']; ?>
                <?php if($item['admin_edited']):?>
                    <br/><br/>
                    <span class="badge pull-right">изменен администратором</span>
                <?php endif ?>
        </section>
    <?php endforeach ?>
    <?php else : ?>
        <br/>
        <h2>Пока никто не оставлял записей, станьте первым</h2>
        <br/><br/>
    <?php endif; ?>


    <section class="well row preview_template hide">
        <span class="col-md-2"><div class="preview_image"></div></span>
        <span class="pull-left">
            Имя:&nbsp; </span> <h3> <span class="name"></span> &nbsp;
            Email: <span class="email"><?php echo $item['email']; ?></span>
        </h3>
        <hr/>
        Сообщение: <span class="message"></span>
    </section>
</div>

<div class="add-form well">

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
    <form class="well add_form" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" required="required">
        </div>
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" placeholder="Имя" name="name">
        </div>
        <div class="form-group">
            <label for="message">Сообщение</label>
            <textarea type="text" class="form-control" id="message" placeholder="Сообщение" name="message" required="required"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Аватар (необязательно)</label>
            <input type="file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-default">Отправить</button>
        <button class="btn btn-default" onClick="return showPreview()">Предпросмотр</button>
    </form>
</div>
