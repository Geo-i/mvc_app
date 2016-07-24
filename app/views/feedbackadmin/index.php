<header>
    <div class="page-header">  <a class="btn btn-default pull-right
        <?php if(!empty($admin)): ?>active<?php endif ?>" href="/administrator/logout" >Выйти</a>
        <h1><a href="/"><?php echo $this->title ?></a></h1> <br/>
        <div class="small">Форма обратной связи с пре-модерацией на чистом PHP + MySQL и Twitter Bootstrap</div>
    </div>
</header>

<div class="feedbacks">

    <br/>

    <?php if(!empty($this->added_successfully)): ?>
        <div class="well success">
            <div><strong>Сообщение успешно добавлено и появится после проверки модератором</strong> <br/></div>
            <div><br/></div>
        </div>
    <?php endif ?>

    <?php if($this->all_items) : ?>
    <?php foreach($this->all_items as $item): ?>
        <section class="well row  <?php if($item['status'] == 'new'): ?>text-success<?php endif ?>" >
            <a href="#" class="col-md-2">
                <?php if($item['image']):
                    ?><img src="/avatars/<?php echo $item['id'] ?>.jpg" width="100" height="70"><?php
                else :
                    ?><img src="http://placehold.it/100x70">
                <?php endif ?>
            </a>
            <span class="pull-left">Имя:&nbsp; </span>
            <div>
                <?php echo $item['name']; ?> &nbsp; Email: <?php echo $item['email']; ?>
            </div>
            <hr/>
            Сообщение: <span > <?php echo $item['message']; ?></span>
            <?php if($item['status'] != 'rejected'): ?>
            <div>
                <div class="pull-right">
                    <a href="/feedback/reject/?id=<?php echo $item['id'] ?>" class="btn btn-danger">Отклонить</a>
                    <?php if($item['status'] == 'aproved'): ?>
                        <div  class="btn btn-success disabled">Одобрено</div>
                    <?php else: ?>
                         <a href="/feedback/aprove/?id=<?php echo $item['id'] ?>" class="btn btn-success">Одобрить</a>
                     <?php endif ?>
                    <a href="/feedback/edit/?id=<?php echo $item['id'] ?>" class="btn btn-default">Редактировать</a>
                </div>
            </div>
            <?php else : ?>
                <div><div class="btn btn-danger pull-right disabled">Отклонен</div></div>
            <?php endif; ?>

        </section>
    <?php endforeach ?>
    <?php endif; ?>

</div>