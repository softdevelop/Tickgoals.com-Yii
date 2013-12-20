<style>
    @font-face {

    }
    .main-box{margin:0 auto;padding-top:60px}
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


<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
        </div>
<div>