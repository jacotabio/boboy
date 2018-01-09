var b_chatid;
var current;
$(document).ready(function(){
    $("body").on("click",".btn-chat", function(e){
        b_chatid = $(this).val();
        if($("#chat-modal").modal()){
            $("#chat-modal-title").html(b_chatid);
            loadChat(b_chatid);
        }
    });
    $("#loginform").on("submit",function(e){
        e.preventDefault();
        $("#btn-login").prop("disabled",true);
        $.ajax({
            url:"../login/ajax.php",
            method:"POST",
            data:$(this).serialize(),
            success:function(data){
            if(data == "login_success"){
                window.location = "/admin/";
            }
            if(data == "login_failed"){
                alert("Username or password does not exist");
            }
            $("#btn-login").prop("disabled",false);
            }
        });
    });

    $("#form-chat").on("submit",function(e){
        e.preventDefault();
        var msg = $("#chat-input-message").val();
        if(msg == "" || msg == null){
    
        }else{
          var data = $(this).serializeArray();
          data.push({name: 'brand_id', value: b_chatid});
          $("#chat-input-message").val("");
          $.ajax({
            url:"modules/chat/send_message.php",
            method:"POST",
            data: data,
            success:function(data){
                if(data == "message_sent"){
                    loadChat(b_chatid);
                }
                if(data == "message_failed"){
    
                }
            }
          });
        }
    });

    function loadChat(b_chatid){
        var cac = $("#chat-ajax-content");
        current_content = cac.html();
        $.ajax({
          url: "modules/chat/ajax.php",
          method: "POST",
          data:{
            "chat_content": 1,
            "brand_id":b_chatid
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
              setTimeout(function(){
                scrollBottomChat();
              },100);
            }
          }
        });
    }

    var tblpen = $('#table-pending-orders').DataTable( {
        columnDefs: [
        {
            "className": ["dt-right"],
            "targets": [3,4]
        }],
        bDeferRender:true,
        responsive:true,
        ajax: {
            url: "modules/orders/pending.php",
            type: "POST"
        },
        rowId: 'order_id',
        columns:[
            { "data": "order_id"},
            { "data": "datetime"},
            { "data": "customer"},
            { "data": "price"},
            { "data": "status" }
        ],
        oLanguage:{
            sProcessing: "Loading orders",
            sZeroRecords: "No orders"
        }
    });

    setInterval( function () {
        tblpen.ajax.reload();
    }, 5000 );
    
    function scrollBottomChat(){
        $(".chat-panel-body").animate({ scrollTop: $('.chat-panel-body').prop("scrollHeight")}, 250);
    };

    $('#table-pending-orders').on( 'click', 'tr', function () {
        // Get the rows id value
        var id = tblpen.row( this ).id();
        // Filter for only numbers
        id = id.replace(/\D/g, '');
        // Transform to numeric value
        id = parseInt(id, 10);
        // Redirect to order details page
        window.location = "/admin/?p=orders&o="+id;
        //alert( 'Clicked row id '+id );
      });
});

/*
Template Name: Monster Admin
Author: Themedesigner
Email: niravjoshi87@gmail.com
File: js
*/
$(function() {
    "use strict";
    $(function() {
        $(".preloader").fadeOut();
    });
    jQuery(document).on('click', '.mega-dropdown', function(e) {
        e.stopPropagation()
    });
    // ============================================================== 
    // This is for the top header part and sidebar part
    // ==============================================================  
    var set = function() {
        var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
        var topOffset = 70;
        if (width < 500) {
            $("body").addClass("mini-sidebar");
            $('.navbar-brand span').hide();
            $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");
            $(".sidebartoggler i").addClass("ti-menu");
        } else {
            $("body").removeClass("mini-sidebar");
            $('.navbar-brand span').show();
            $(".sidebartoggler i").removeClass("ti-menu");
        }

        var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $(".page-wrapper").css("min-height", (height) + "px");
        }

    };
    $(window).ready(set);
    $(window).on("resize", set);

    // topbar stickey on scroll

    $(".fix-header .topbar").stick_in_parent({

    });

    // this is for close icon when navigation open in mobile view
    $(".nav-toggler").click(function() {
        $("body").toggleClass("show-sidebar");
        $(".nav-toggler i").toggleClass("ti-menu");
        $(".nav-toggler i").addClass("ti-close");
    });
    $(".sidebartoggler").on('click', function() {
        $(".sidebartoggler i").toggleClass("ti-menu");
    });

    // ============================================================== 
    // Auto select left navbar
    // ============================================================== 
    $(function() {
        var url = window.location;
        var element = $('ul#sidebarnav a').filter(function() {
            return this.href == url;
        }).addClass('active').parent().addClass('active');
        while (true) {
            if (element.is('li')) {
                element = element.parent().addClass('in').parent().addClass('active');
            } else {
                break;
            }
        }
    });

    // ============================================================== 
    // Sidebarmenu
    // ============================================================== 
    $(function() {
        $('#sidebarnav').metisMenu();
    });
    // ============================================================== 
    // Slimscrollbars
    // ============================================================== 
    $('.scroll-sidebar').slimScroll({
        position: 'left',
        size: "5px",
        height: '100%',
        color: '#dcdcdc'
    });

    // ============================================================== 
    // Resize all elements
    // ============================================================== 
    $("body").trigger("resize");
});

