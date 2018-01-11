<?php
include '../../library/config.php';
include '../../classes/class.brands.php';
include '../../classes/class.chats.php';

$chat = new Chats();
$brand = new Brands();

function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'min',
      's' => 'sec',
  );
  foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
          unset($string[$k]);
      }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'Just now';
}

if(isset($_POST['chat_content'])){ 
    $g = $chat->get_convo($_SESSION['admin_id'],$_POST['brand_id']);
    if($g){
        $m = $chat->retrieve_messages($g);?>
    <div>
    <ul id="chat-scroll" class="chat">
    <?php  
    if($m){ 
        foreach($m as $_m){
            if($_m['sender_id'] == $_SESSION['admin_id']){?>
                <li class="right">
                    <span class="chat-img pull-right">
                    <img src="../img/logo.png" alt="User Avatar" data-toggle="tooltip" title="<?php $date = new DateTime($_m['created_at']);echo $date->format('g:i A m/d/y');?>" data-placement="right" class="img-circle img-responsive chat-img" data-animation="false"/>
                    </span>
                    <div class="chat-body clearfix">
                        <div style="margin-top:5px;">
                            <div style="display:inline-block;width:100%;">
                                <p class="pull-right"><?php echo $_m['msg'];?></p>
                            </div>
                        </div>
                    </div>
                </li>
            <?php
            }else{?>
                <li class="left">
                    <span class="chat-img pull-left">
                    <img src="http://placehold.it/40/FA6F57/fff&text=<?php echo $firstCharacter = substr($chat->get_name($_m['sender_id']), 0, 1);?>" alt="User Avatar" data-toggle="tooltip" title="<?php $date = new DateTime($_m['created_at']);echo $date->format('m/d/y g:i A');?>" data-placement="left" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                        <div style="margin-top:5px">
                            <div style="display:inline-block; width:100%;">
                                <p class="pull-left"><?php echo $_m['msg']?></p>
                            </div>
                        </div>
                    </div>
                 </li>
            <?php
            }
        }
    }
    ?>
    </ul>
    </div>
    <?php
    }else{
        echo "Say hello";
    }
    ?>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip({
            'selector': '',
            'container':'body'
        }); 
    });
    </script>
    <?php
}
?>