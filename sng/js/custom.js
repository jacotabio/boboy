 // Custom JavaScript //
 var counter = 0;
 var counter_holder = 0;
 var user_id;
 var brand_id;
 var current;
 var chat_current;
 var realtime = true;
 var chat_pov;
 var pageLoad = 0;
 var executed = false;

Array.prototype.diff = function(a) {
  return this.filter(function(i) {return a.indexOf(i) < 0;});
};

 function showShopStatus(){
  var bid = $("#shop-cpanel-id").attr("value");
  $.ajax({
      url: "modules/cpanel/ajax.php",
      method: "POST",
      data:{
        "show_status": 1,
        "brand_id":bid
      },
      success: function(data){
        setTimeout(function() {
          if(data == 1){
            $("#show-shop-status").html("Online");
            $("#id-name--1").prop('checked', true);
            $("#status-indicator").removeClass("orange").addClass("green");
          }
          if(data == 0){
            $("#show-shop-status").html("Offline");
            $("#id-name--1").prop('checked', false);
            $("#status-indicator").removeClass("green").addClass("orange");
          }
        }, 0);
      }
  });
};
function remove_cart_show(c_id){
  $("#cart_modal").modal();
  document.getElementById('id_remove').value = c_id;
}

function updateCartCounter()
{ 
$("#nav-id").load(window.location.href + " #nav-id" );
}

function returnIndex(){
  window.location = "/sng";
}

function returnShopOrders(){
  window.location = "/sng/?mod=cpanel&t=orders";
}
function returnUserOrders(){
  window.location = "/sng/?mod=profile&t=orders";
}

function reloadPage(){
  location.reload();
}

$("#item-unavailable").on("hidden.bs.modal", function () {
  reloadPage();
});

$("#update-complete-modal").on("hidden.bs.modal", function () {
  reloadPage();
});

$("#modal-login").on("hidden.bs.modal", function () {
  $("#email-login").val("");
  $("#password-login").val("");
});

$("#error-modal").on("hidden.bs.modal", function () {
  reloadPage();
});

$("#insert-complete-modal").on("hidden.bs.modal", function () {
  window.location = "index.php?mod=cpanel&t=items";
});

$("#order-removed-modal").on("hidden.bs.modal", function () {
  returnShopOrders();
});

$('#edit-item-price').on('keypress', function(e){
  return e.metaKey || // cmd/ctrl
    e.which <= 0 || // arrow keys
    e.which == 8 || // delete key
    /[0-9]/.test(String.fromCharCode(e.which)); // numbers
});

$('#add-item-price').on('keypress', function(e){
  return e.metaKey || // cmd/ctrl
    e.which <= 0 || // arrow keys
    e.which == 8 || // delete key
    /[0-9]/.test(String.fromCharCode(e.which)); // numbers
});

function removeURLParameter(url, parameter) {
  //prefer to use l.search if you have a location/link object
  var urlparts= url.split('?');   
  if (urlparts.length>=2) {

      var prefix= encodeURIComponent(parameter)+'=';
      var pars= urlparts[1].split(/[&;]/g);

      //reverse iteration as may be destructive
      for (var i= pars.length; i-- > 0;) {    
          //idiom for string.startsWith
          if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
              pars.splice(i, 1);
          }
      }

      url= urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
      return url;
  } else {
      return url;
  }
}

function insertParam(key, value){

    key = encodeURI(key); value = encodeURI(value);

    var kvp = document.location.search.substr(1).split('&');

    var i=kvp.length; var x; while(i--) 
    {
        x = kvp[i].split('=');

        if (x[0]==key)
        {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if(i<0) {kvp[kvp.length] = [key,value].join('=');}

    //this will reload the page, it's likely better to store this until finished
    document.location.search = kvp.join('&');  
}

var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;

  for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : sParameterName[1];
      }
  }
};





 // DOCUMENT READY //

$(document).ready(function(){
  
  checknotif();

  var order_id = getUrlParameter('o_id');
  showActiveShops();
  showShopStatus();
  displayShopItems(getUrlParameter('brand'),getUrlParameter('search'));
  displayCartTable();
  if(order_id==null){
    displayOrders();
  }
  displayUserOrders();
  orderInfo();

  
  // CPanel Order ID
  
  if(order_id && getUrlParameter('t') != "orders"){
    window.location = "/sng/?mod="+getUrlParameter('mod');;
  }
  function showActiveShops(){
    $.ajax({
      url: "modules/shop/ajax.php",
      method: "POST",
      data:{
        "display_active_shops":1
      },
      success:function(data){
        $("#active-shops-container").html(data);
        //alert("asd");
        //setTimeout(showActiveShops,2000);
      }
    });
  }

  function orderInfo(){
    // Check/Display if isset order_id
    if(getUrlParameter('mod')=="profile" && getUrlParameter('t') == "orders"){
      if(order_id){
        $.ajax({
          url: "modules/profile/ajax.php",
          method: "POST",
          data:{
            "order_info":1,
            "order_id":order_id
          },
          success:function(data){
            setTimeout(function(){
              if(data == "unknown_order"){
                window.location = "/sng/?mod=profile&t=orders";
              }else{
                $("#user-orderinfo-ajax-content").html(data);
              }
            },0);
          }
        });
      }
    }else if(getUrlParameter('mod')=="cpanel" && getUrlParameter('t') == "orders"){
      if(order_id){
        $.ajax({
          url: "modules/cpanel/ajax.php",
          method: "POST",
          data:{
            "order_info":1,
            "order_id":order_id
          },
          success:function(data){
            setTimeout(function(){
              if(data == "order_unavailable"){
                window.location = "/sng/?mod=cpanel&t=orders";
              }else{
                $("#orderinfo-ajax-content").html(data);
              }
            },0);
          }
        });
      }
    }
  }
  if(getUrlParameter('mod')){

  }

  $("#form-brand-chat").on("submit",function(e){
    e.preventDefault();
    var msg = $("#chat-input-message").val();
    if(msg == "" || msg == null){

    }else{
      var data = $(this).serializeArray();
      data.push({name: 'user_id', value: user_id});
      $("#chat-input-message").val("");
      $.ajax({
        url:"modules/chat/send_message.php",
        method:"POST",
        data: data,
        success:function(data){
          if(data == "message_sent"){
            loadChat(user_id);
          }
          if(data == "message_failed"){
            alert("An error has occured. Please try again.");
          }
        }
      });
    }
  });

  $("#form-user-chat").on("submit",function(e){
    e.preventDefault();
    var msg = $("#chat-input-message").val();
    if(msg == "" || msg == null){

    }else{
      var data = $(this).serializeArray();
      data.push({name: 'brand_id', value: brand_id});
      $("#chat-input-message").val("");
      $.ajax({
        url:"modules/chat/send_message.php",
        method:"POST",
        data: data,
        success:function(data){
          if(data == "message_sent"){
            loadUserChat(brand_id);
          }
          if(data == "message_failed"){

          }
        }
      });
    }
  });

  function scrollBottomChat(){
    $(".chat-panel-body").animate({ scrollTop: $('.chat-panel-body').prop("scrollHeight")}, 250);
  };

  $('body').on("click",".qc-button", function(e){
    brand_id = $(this).attr("value");
    if($("#chat-modal").modal()){
      loadUserChat(brand_id);
    }
  });

  $('body').on("click","#btn-cancel-order", function(e){
    e.preventDefault();
    $("#cancel-order-modal").modal();
  });

  $('body').on("click","#btn-confirm-cancel-order", function(e){
    $.ajax({
      url: "modules/profile/ajax.php",
      method: "POST",
      data:{
        "cancel_order":1,
        "order_id":order_id
      },
      success:function(data){
        setTimeout(function(){
          if(data == "order_cancelled"){
            window.location = "/sng/?mod=profile&t=orders";
          }
          if(data == "cancel_too_late"){
            
            $("#cancel-late-modal").modal();
          }
        },500)
      }
    });
  });

  $('body').on("click",".oi-remove", function(e){
    var oi_id = $(this).val();
    $("#oi-remove-confirm").val(oi_id);
    $("#oi-remove-modal").modal();
  });

  $('body').on("click","#oi-remove-confirm", function(e){
    var oi_id = $(this).val();
    $.ajax({
      url: "modules/cpanel/ajax.php",
      method: "POST",
      data:{
        "oi_remove":1,
        "oi_id":oi_id,
        "order_id":getUrlParameter('o_id')
      },
      success:function(data){
        if(data == "order_removed"){
          $("#order-removed-modal").modal();
        }
        if(data == "oi_removed"){
          orderInfo();
        }
      }
    });
  });

  $('body').on("click","#scroll-bottom", function(e){
    scrollBottomChat();
  });

  $('body').on("click","#open-chat", function(e){
    e.preventDefault();
    $('#chat-input-message').focus();
    
    user_id = $("#open-chat").attr("value");
    
    if($("#chat-modal").modal()){
      loadChat(user_id);
    }
    $.ajax({
      url: "modules/cpanel/ajax.php",
      method: "POST",
      data:{
        "get_chat_name":1,
        "id":user_id
      },
      success:function(data){
        $("#chat-modal-title").html(data);
      }
    });
    
  });

  function loadChat(user_id){
    var cac = $("#chat-ajax-content");
    
    current_content = cac.html();
    $.ajax({
      url: "modules/chat/ajax.php",
      method: "POST",
      data:{
        "chat_content": 1,
        "user_id":user_id
      },
      success: function(data){
        if(current == null || current == ""){
          setTimeout(function() {
            scrollBottomChat();
          }, 500);
        }
        if(current != data) {
          current = data;
          cac.html(data);
          if(!($("#chat-modal").data('bs.modal') || {}).isShown){
            var chatmsg = "New Message";
            var from = "User";
            //chatNotify(from,chatmsg);
          }else{
            setTimeout(function(){
              scrollBottomChat();
            },100);
          }
        }
      }
    });
  }

  function loadUserChat(brand_id){
    var cac = $("#chat-ajax-content");
    current_content = cac.html();
    $.ajax({
      url: "modules/chat/ajax.php",
      method: "POST",
      data:{
        "chat_content_user": 1,
        "brand_id":brand_id
      },
      success: function(data){
        if(current == null || current == ""){
          setTimeout(function() {
            scrollBottomChat();
          }, 500);
        }
        if(current != data) {
          current = data;  
          cac.html(data);
          if(!($("#chat-modal").data('bs.modal') || {}).isShown){
            var chatmsg = "New Message";
            var from = "Starbucks";
            chatNotify(from,chatmsg);
          }else{
            setTimeout(function(){
              scrollBottomChat();
            },100);
          }
        }
      }
    });
  }
  function chatNotify(from,chatmsg){
    $.notify({
      icon: 'https://randomuser.me/api/portraits/med/men/77.jpg',
      title: from,
      message: chatmsg
    },{
      type: 'minimalist',
      delay: 5000,
      icon_type: 'image',
      template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<img data-notify="icon" class="img-circle pull-left">' +
        '<span data-notify="title">{1}</span>' +
        '<span data-notify="message">{2}</span>' +
      '</div>',
      placement: {
        from: 'bottom',
        align: 'left'
      },
      offset: 20,
      spacing: 10,
      z_index: 1031,
    });
  }
  $('body').on("click","#notify", function(e){
    
  });

  $('body').on("click","#order-ready", function(e){
    $.ajax({
      url: "modules/cpanel/ajax.php",
      method: "POST",
      data:{
        "order_ready":1,
        "order_id":order_id
      },
      success: function(data){
        orderInfo();
      }
    });
  });

  $('body').on("click","#order-claimed", function(e){
    $.ajax({
      url: "modules/cpanel/ajax.php",
      method: "POST",
      data:{
        "order_claimed":1,
        "order_id":order_id
      },
      success: function(data){
        orderInfo();
      }
    });
  });

  $('body').on("click","#accept-order", function(e){
    $.ajax({
      url: "modules/cpanel/ajax.php",
      method: "POST",
      data:{
        "accept_order":1,
        "order_id":order_id
      },
      success: function(data){
        orderInfo();
      }
    });
  });
  $('body').on("click","#decline-order", function(e){
    $.ajax({
      url: "modules/cpanel/ajax.php",
      method: "POST",
      data:{
        "decline_order":1,
        "order_id":order_id
      },
      success: function(data){
        orderInfo();
      }
    });
  });

  $('body').on("click",".select-order", function(e){
    var oid = $(this).attr("id");
    window.location = "/sng/?mod=cpanel&t=orders&o_id="+oid;
  });

  $('body').on("click",".user-select-order", function(e){
    var oid = $(this).attr("id");
    window.location = "/sng/?mod=profile&t=orders&o_id="+oid;
  });

  function displayShopItems(bid,search){
    $.ajax({
        url: "modules/shop/ajax.php",
        method: "POST",
        data:{
          "display_shop": 1,
          "brand_id": bid,
          "search_val": search
        },
        success: function(data){
          setTimeout(function() {
            $("#shop-ajax-content").html(data);
          }, 0);
        }
    });
  };
  function displayOrders(){
    $.ajax({
        url: "modules/cpanel/ajax.php",
        method: "POST",
        data:{
          "display_orders": 1,
        },
        success: function(data){
          setTimeout(function() {
            if(current != data) {
              current = data;
              $("#orders-ajax-content").html(data);
            }
            /*
            if($('div.dataTables_filter input').is(":focus")){
              alert("naga focus ka");
            }else{
              alert("wala");
            }*/
          }, 0);
        }
    });
  };
  function displayUserOrders(){
    $.ajax({
        url: "modules/profile/ajax.php",
        method: "POST",
        data:{
          "display_orders": 1,
        },
        success: function(data){
          setTimeout(function() {
            $("#user-orders-ajax-content").html(data);
          }, 0);
        }
    });
  };

  $("#id-name--1").change(function(){
    var bid = $("#shop-cpanel-id").attr("value");
    if (this.checked) {
      $.ajax({
        url: "modules/cpanel/ajax.php",
        method: "POST",
        data:{
          "change_status": 1,
          "brand_id":bid,
          "checked": 1
        },
        success: function(data){
          showShopStatus();
        }
      });
    }else{
      $.ajax({
        url: "modules/cpanel/ajax.php",
        method: "POST",
        data:{
          "change_status": 1,
          "brand_id":bid,
          "checked": 0
        },
        success: function(data){
          showShopStatus();
        }
      });
    }
  });

  $("#shop-search-item").on("submit",function(e){
    e.preventDefault();
    var search_value = $("#shop-search-value").val();
    if(search_value == ""){
      var originalURL = window.location.href;
      window.location = removeURLParameter(originalURL,"search");
    }else{
      insertParam("search",search_value);
    }
  });

  $('#shop-filter-by').bind('change', function (e) { // bind change event to select
    var brand_id = $(this).val(); // get selected value
    e.preventDefault();
    if(brand_id == 0){
      var originalURL = window.location.href;
      window.location = removeURLParameter(originalURL,"brand");
    }else{
      insertParam("brand",brand_id);
    }
  });

  $('#search-form').on("submit", function(e){
    e.preventDefault();
    var search_value = document.getElementById('cpanel-search-item').value;
    if(search_value == "" || search_value == null || search_value == " "){
      window.location = "index.php?mod=cpanel&t=items";
    }else{
      window.location = "index.php?mod=cpanel&t=items&search="+search_value;
    }
  });

  $("#btn-delete-item").click(function(){
    var item_id = $(this).attr("value");
    $("#delete-item-confirm").modal();
    $("#btn-delete-item-true").val(item_id);
  });

  $("#btn-delete-item-true").click(function(){
    var item_id = $(this).attr("value");
    $.ajax({
      url: 'modules/cpanel/itemview_delete.php',
      method: 'POST',
      data:{
        "delete_id": item_id,
      },
      success: function(data){
        if(data == "delete_success"){
          window.location = "index.php?mod=cpanel&t=items";
        }
      }
    });
  });

  $('#add-item-form').on("submit", function(e){
    e.preventDefault();
    $('#loading-modal').modal({backdrop: 'static', keyboard: false});
    $("#btn-add-item").prop("disabled", true);
    var formData = new FormData(this);

    $.ajax({
      url: 'modules/cpanel/itemview_add.php',
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(data){
        setTimeout(function(){
          if(data == "insert_success"){
            $("#btn-add-item").prop("disabled", false);
            $("#insert-complete-modal").modal();
          }
        },0);
      }
    });
  });

  $('#edit-item-form').on("submit", function(e){
    e.preventDefault();
    $('#loading-modal').modal({backdrop: 'static', keyboard: false});
    $("#btn-delete-item").prop("disabled", true);
    $("#btn-save-edit-item").prop("disabled", true);
    var formData = new FormData(this);

    $.ajax({
      url: 'modules/cpanel/itemview_edit.php',
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(data){
        setTimeout(function(){
          if(data == "update_success"){
            $("#btn-save-edit-item").prop("disabled", false);
            $("#btn-delete-item").prop("disabled", false);
            $('#loading-modal').modal('hide');
            $("#update-complete-modal").modal();
          }
        },2000);
        
      }
    });
  });

  $('body').on("click",".item-select", function(e){

    var item_id = $(this).attr("id");
    window.location = "index.php?mod=cpanel&t=items&q="+item_id;

  });
  $('body').on("click", "#btn-order", function(e){
    $.ajax({
      url: 'modules/cart/order.php',
      method: 'POST',
      data:{
        "submit_order": 1
      },
      success: function(data){
        if(data == "order_success"){
          $("#cart_success").modal();
          displayCartTable();
          updateCartCounter();
        }
        if(data == "empty_cart"){
          $("#error-modal").modal();
        }
      }
    });
  });
  
  $("#remove_btn").click(function(){
    $("#remove_btn").prop('disabled',true);
    var r_id = $("#id_remove").val();
    
    $.ajax({
      url: 'modules/cart/ajax.php',
      method: 'POST',
      data:{
        "remove_cart": 1,
        "remove_id": r_id
      },
      success: function(data){
        if(data == "check_error" || data == "remove_failed"){
          alert("An error occurred. Please try again.");
          $("#cart_modal").modal('hide');
          window.location = "index.php?mod=cart";
        }else if(data == "remove_success"){
          displayCartTable();
          updateCartCounter();
          $("#cart_modal").modal('hide');
        }
        $("#remove_btn").prop('disabled',false);
      }
    });
  });

  function displayCartTable(){
    $.ajax({
        url: "modules/cart/display.php",
        method: "POST",
        data:{
          "display_cart": 1
        },
        success: function(data){
          setTimeout(function() {
            $("#cart-content").html(data);
          }, 0);
        }
    });
  };

  $("#atc-form").on("submit", function(e){
    $("#btn-atc").prop("disabled",true);
    $("#modal_loading").modal();
    e.preventDefault();
    $.ajax({
      url: 'modules/item/ajax.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(d){
        setTimeout(function(){
          if(d=="item_unavailable"){
            $("#item-unavailable").modal();
          }
          if(d=="cart_inserted"){
            $("#modal_inserted").modal();
            updateCartCounter();
          }
          if(d=="cart_updated"){
            $("#modal_updated").modal();
            updateCartCounter();
          }
          if(d=="no_session"){
            $("#modal_session").modal();
          }
          if(d=="session_brand"){
            alert("You are not eligible to process this transaction.");
          }
          $("#btn-atc").prop("disabled",false);
        },0);
      }
    });
  });
  //-- Logout Ajax --//
  $('#btn-logout').click(function(){
    $.ajax({
      url: 'logout.php',
      success: function(d){
        window.location = "index.php";
        location.reload();
      }
    });
  });
  //-- End Logout Ajax --//
  //-- Login Ajax --//
  $("#login-form").on("submit", function(e){
    e.preventDefault();
    $('#submit-login').prop('disabled', true);
    var e_email = document.getElementById("email-log");
    var e_pwd = document.getElementById("pwd-log");

    
    $.ajax({
      url: 'modules/login/ajax.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(d){
        if(d=="login_success"){
          location.reload();
          $('#submit-login').prop('disabled', false);
        }
        if(d=="login_failed"){
          e_pwd.classList.add("has-error");
          e_email.classList.add("has-error");
          document.getElementById("pwd-login-help").innerHTML = "Username or password does not exists";
          $('#submit-login').prop('disabled', false);
        }
      }
    });
  });
  //-- End Login Ajax --//

  //-- Register Ajax Function --//
  $("#register-form").on("submit", function(e){
    e.preventDefault();
    $('#submit-register').prop('disabled', true);
    var e_pwd = document.getElementById("pwd-reg");
    var e_cpwd = document.getElementById("cpwd-reg");

    var e_email = document.getElementById("email-reg");
    $.ajax({
      url: 'modules/register/ajax.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function (d) {
        setTimeout(function(){
          if(d == "non_match_password"){
            e_pwd.classList.add("has-error");
            e_cpwd.classList.add("has-error");
            document.getElementById("pwd-reg-help").innerHTML = "Passwords do not match";
          }
          if(d == "email_exists"){
            e_email.classList.add("has-error");
            document.getElementById("email-reg-help").innerHTML = "Email already exists";
          }
          if(d=="brand_registered"){
            $("#brand-registered").modal();
          }
          if(d=="user_registered"){
            $("#user-registered").modal();
          }
          $('#submit-register').prop('disabled', false);
        },0);
      }
    });
  });

  function filter(obj1, obj2) {
    var result = {};
    for(key in obj1) {
        if(obj2[key] != obj1[key]) result[key] = obj2[key];
        if(typeof obj2[key] == 'array' && typeof obj1[key] == 'array') 
            result[key] = arguments.callee(obj1[key], obj2[key]);
        if(typeof obj2[key] == 'object' && typeof obj1[key] == 'object') 
            result[key] = arguments.callee(obj1[key], obj2[key]);
    }
    return result;
  }

  function jsonEqual(a,b) {
    return JSON.stringify(a) === JSON.stringify(b);
  }
  function compareJSON(obj1, obj2) { 
    var ret = {}; 
    for(var i in obj2) { 
      if(!obj1.hasOwnProperty(i) || obj2[i] !== obj1[i]) { 
        ret[i] = obj2[i]; 
      } 
    } 
    return ret; 
  }
  //-- End Register Ajax --//
  function chatListener(){  
    
    $.ajax({
      type: 'POST',
      url : 'modules/chat/realtime.php',
      data: {
        "load_new_chat":1
      },
      //dataType: 'html',
      dataType: 'json',
      success: function(data){
        //console.log(data);
        var aik = [{'sender':'sbux',"msg":"hi","timestamp":"123"}];

        var dif = [{'sender':'sbux',"msg":"hi","timestamp":"123"},{'sender':'sbux',"msg":"musta?","timestamp":"123"},{'sender':'sbux',"msg":"wala coffee","timestamp":"123"}];
        
        console.log(filter(aik,dif));
        //console.log(filter(chat_current, data));


        //alert(jsonEqual(dat, cur));
        //alert(JSON.stringify(cur.diff(dat)));
        if(!executed){
          chat_current = data;
          executed = true;
          //alert(JSON.stringify(compareJSON(a,b)));
          //alert(JSON.stringify(data[0]));
        }else{
          if(chat_current != data){
            var JSONdata = JSON.parse(JSON.stringify(data));
            var JSONcurrent = JSON.parse(JSON.stringify(chat_current));
            //alert("may bag-o yow");
            //alert(JSON.stringify(compareJSON(JSONcurrent,JSONdata)));

            //alert(data);
            //string_data = JSON.stringify(data);
            //string_current = JSON.stringify(chat_current);
            //alert(JSON.stringify(compareJSON(chat_current, data)));
            //alert(string_data);
            //alert(chat_current.diff( data ));
            //var diff = $(chat_current).not(data).get();
            //alert(diff);
            //chat_current = data.slice(0);
            //alert(data);
            //chat_current = new_data;
            //chatNotify();
          }else{
            //alert("same");
          }
        }
        
        /*
        $.each(data, function(index, obj){
          alert("success");
          var from = "Starbucks";
          var chatmsg = "yow";
          chatNotify(from,chatmsg);
          //jQuery("#divp4").append('<p><b>Array Index: '+ (index+1) + '</p>');
          //jQuery("#divp4").append('<p><b>Image SRC  : </b>' + obj.src +'</p>');
          //jQuery("#divp4").append('<p><b>PHP LOG    : </b>' + obj.log +'</p>');
          //jQuery("#divp4").append('<p><b>Warnings   : </b>' + obj.warn +'</p>');
          //jQuery("#divp4").append('<p><b>Errors     : </b>' + data.error +'</p>');
        });*/

      }
    });
  }

  function checknotif() {
    if (!Notification) {
      $('body').append('<h4 style="color:red">*Browser does not support Web Notification</h4>');
      return;
    }
    if (Notification.permission !== "granted")
      Notification.requestPermission();
    else {
      $.ajax(
      {
        url : "modules/chat/realtime.php",
        type: "POST",
        success: function(data, textStatus, jqXHR)
        {
          
          //alert(data);
          
          var data = jQuery.parseJSON(data);
          

          if(data.result == true){
            var data_notif = data.notif;
            
            for (var i = data_notif.length - 1; i >= 0; i--) {
              var theurl = data_notif[i]['url'];
              var notifikasi = new Notification(data_notif[i]['title'], {
                icon: data_notif[i]['icon'],
                body: data_notif[i]['msg'],
              });
              
              $.ajax({
                url: "modules/chat/realtime.php",
                type: "POST",
                data:{
                  "update_notif":data_notif[i]['msg_id']
                },
                success:function(data){
                  //alert(data);
                }
              });
              notifikasi.onclick = function () {
                window.open(theurl); 
                notifikasi.close();     
              };
              setTimeout(function(){
                notifikasi.close();
              }, 5000);
            };
          }else{
  
          }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
  
        }
      });	
  
    }
  };
    // Realtime Chat Refresh
    (function chatRealtime() {
      checknotif();
    if(getUrlParameter('mod') && getUrlParameter('t')=="orders" && getUrlParameter('o_id')){
      if(user_id != null && brand_id == null){
        loadChat(user_id);
      }
      if(user_id == null & brand_id != null){
        loadUserChat(brand_id);
      }
    }
       setTimeout(chatRealtime, 2000);
    }());
    
    // Realtime Dynamic Refresh
    (function realtimeCheck() {
      
    if(getUrlParameter('mod') == "shop"){
      showActiveShops();
      displayShopItems(getUrlParameter('brand'),getUrlParameter('search'));
    }
    if(getUrlParameter('t') == "orders" && getUrlParameter('mod') == "cpanel"){
      if(getUrlParameter('o_id') == null){
        displayOrders();
      }
    }
    if(getUrlParameter('mod') == "profile" && getUrlParameter('t') == "orders"){
      orderInfo();
    }
    
       setTimeout(realtimeCheck, 2000);
    }());

});