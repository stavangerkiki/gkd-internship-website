<?php loadPartial('head');?>
<?php loadPartial('navbar');?>
<?php loadPartial('top-banner');?>
<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3"><?= $status ?>错误</div>
        <p class="text-center text-2xl mb-4">
        <?= $message ?>
        </p>
    </div>
</section>
<?php loadPartial('bottom-banner');?>
<?php loadPartial('footer');?>
