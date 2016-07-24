<header>
    <div class="page-header">  <a class="btn btn-default pull-right
        <?php if(!empty($admin)): ?>active<?php endif ?>" href="/administrator" >Администрировать</a>
        <h1><?php echo $this->title ?></h1> <br/>
        <div class="small">Форма обратной связи с пре-модерацией на чистом PHP, MySQL, Twitter Bootstrap и js для предпросмотра сообщения</div>
    </div>
</header>

<div class="content">
    <h1><?php echo $this->message; ?></h1>
    <?php if ($this->debug_message): ?>
        <hr/>
        <div>
            <pre><?php echo $this->debug_message ?></pre>
        </div>
    <?php endif ?>
</div>