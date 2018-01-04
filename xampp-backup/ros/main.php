<div id="tab_content">
    <?php
    $list = $table->get_tables();
    foreach($list as $value){
    ?>
    <a href="index.php?mod=order&sub=<?php echo $value['tab_id'];?>">
    <div class="tab_item stat<?php echo $value['ost_id'];?>">
        <?php echo $value['tab_code'];?>
    </div>
    </a>
    <?php
    }
    ?>
</div>