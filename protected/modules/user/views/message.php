<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />
<style>
    @font-face {

    }
    .main-box{margin:0 auto;width:900px;}
    .box{

        margin: 1em 0;
        padding: 1em 2em;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-left: 8px solid #41B7DB;
        background-color: #F7F7F7;
        font: italic 1.05em/1.55em "Skolar Italic", "Times New Roman", serif;
        color: rgba(0, 0, 0, 0.75);
    }
</style>

<div class="main-box">
    <div class="box">
        <?php
        $message = $content;
        ?>
        <div class="wd-center" style="margin-top:30px; font-size: 1em; overflow-x:auto">
            <?php
            $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
                'heading' => '404',
            ));
            ?>
            <p><strong><?php echo $title;?>! </strong><?php echo $message; ?></p>
            <p><a href="<?php echo $this->createUrl('/');?>">Go Home</a> - <a href="<?php echo $this->createUrl('/');?>">Về trang chủ</a></p>
                       
<?php $this->endWidget(); ?>
        </div>
        <div>