<div id="sub-navigation">
<ul>
    <li><a href="index.php?mod=inventory&sub=ingredients">Ingredients</a></li>
</ul>
</div>
<div id="sub-content">
    <?php
        switch($sub){
            case 'ingredients':
                require_once 'ingredients_index.php';
                break;
        }
    ?>
</div>
