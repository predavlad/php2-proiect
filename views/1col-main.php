<!DOCTYPE html>
<html>
<head>
    <?php echo $this->render('head'); ?>
</head>
<body>

<div class="container">

    <header id="navtop">
        <?php echo $this->render('header'); ?>
    </header>


    <div class="main grid-wrap">
        <section class="grid col-full mq2-col-full">
            <?php echo $this->render('content'); ?>
        </section>
    </div>


    <div class="divide-top">

        <footer class="grid-wrap">
            <?php echo $this->render('footer'); ?>
        </footer>

    </div>

</div>

</body>
</html>
