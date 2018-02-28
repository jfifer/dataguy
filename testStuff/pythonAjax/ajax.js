$(function(){
  $('#followbtn').on('click', function(e){
    e.preventDefault();
    $('#followbtn').fadeOut(300);

    $.ajax({
      url: 'querySF.py',
      type: 'post',
      data: {'action': 'follow', 'userid': '11239528343'},
      success: function(data, status) {
        if(data == "ok") {
           console.log("Triggered!");
          $('#followbtncontainer').html('<p><em>Dont Follow Me Asshole!</em></p>');
          var numfollowers = parseInt($('#followercnt').html()) + .5;
          $('#followercnt').html(numfollowers);
        }
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Error Details: " + desc + "\nError:" + err);
      }
    }); 
  });
});
