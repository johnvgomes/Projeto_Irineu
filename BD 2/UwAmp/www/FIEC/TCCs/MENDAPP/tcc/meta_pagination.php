  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <script type="text/javascript">
  $(document).ready(function(){
    function loading_show(){

    }
    function loading_hide(){
      $('#loading').fadeOut('fast');
    }                
    function loadData(page){
      loading_show();                    
      $.ajax
      ({
        type: "POST",
        url: "load_data.php",
        data: { page : page, url : location.href.replace(/.*\/([a-zA-Z0-9\-]+)\.php.*/,"$1")  },
        success: function(msg)
        {
          $("#container").ajaxComplete(function(event, request, settings)
          {
            loading_hide();
            $("#container").html(msg);
          });
        }
      });
    }
                loadData(1);  // For first time page load default results
                $('#container .pagination li.active').live('click',function(){
                  var page = $(this).attr('p');
                  loadData(page);
                  
                });           
                $('#go_btn').live('click',function(){
                  var page = parseInt($('.goto').val());
                  var no_of_pages = parseInt($('.total').attr('a'));
                  if(page != 0 && page <= no_of_pages){
                    loadData(page);
                  }else{
                    alert('Entre com um número entre '+no_of_pages);
                    $('.goto').val("").focus();
                    return false;
                  }
                  
                });
              });
  </script>

  <style type="text/css">
  .data{color: #fff;}

  #loading{
    width: 100%;
    position: absolute;
    top: 100px;
    left: 100px;
    margin-top:200px;
  }
  #container .pagination ul li.inactive,
  #container .pagination ul li.inactive:hover{
    background-color: #000000;
    color: #FFFFFF;
    border: 1px solid #000000;
    cursor: default;
  }
  #container .data ul li{
    list-style: none;
    font-family: verdana;
    margin: 5px 0 5px 0;
    color: #fff;
    font-size: 17px;
  }

  #container .pagination{
    width: 800px;
    height: 25px;
  }
  #container .pagination ul li{
    list-style: none;
    float: left;
    border: 1px solid #000000;
    padding: 2px 6px 2px 6px;
    margin: 0 3px 0 3px;
    font-family: arial;
    font-size: 14px;
    color: #FFFFFF;
    background-color: #000;
  }
  #container .pagination ul li:hover{
    color: #fff;
    background-color: #006699;
    cursor: pointer;
  }
  .go_button{
    background-color: #820000;
    border: 1px solid #000000;
    color: #FFFFFF;
    padding: 2px 6px 2px 6px;
    cursor: pointer;
    position: absolute;
    margin-top: -1px;
  }
  .total
  {
    float:right;font-family:arial;color:#999;
  }



  </style>