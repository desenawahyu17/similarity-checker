$(document).ready( function () {
    var contentArray=[];
    var index="";
    var clickedIndex="";  
    var minimumLength=$('.read-more-less').attr('data-id');
    var initialContentLength=[];
    var initialContent=[];  
    var readMore=".....<br/><button class='btn btn-info mt-2 read-more'>View More</button>";
    var readLess="<br/><button class='btn btn-info mt-2 read-less'>See a little</button>";  
      $('.read-toggle').each(function(){
      index = $(this).attr('data-id');  
      contentArray[index] = $(this).html();
      initialContentLength[index] = $(this).html().length;
      if(initialContentLength[index]>minimumLength) {
        initialContent[index]=$(this).html().substr(0,minimumLength);
      }else {
        initialContent[index]=$(this).html();
      } 
        $(this).html(initialContent[index]+readMore);
      //console.log(initialContent[0]);  
        
      
    });
      $(document).on('click','.read-more',function(){
        $(this).fadeOut(300, function(){
        clickedIndex = $(this).parents('.read-toggle').attr('data-id');
        $(this).parents('.read-toggle').html(contentArray[clickedIndex]+readLess);  
        });
      });
    $(document).on('click','.read-less',function(){
        $(this).fadeOut(300, function(){
        clickedIndex = $(this).parents('.read-toggle').attr('data-id');
        $(this).parents('.read-toggle').html(initialContent[clickedIndex]+readMore);  
        });
      }); 
});

$('#menu-action').click(function() {
  $('.sidebar').toggleClass('active');
  $('.main').toggleClass('active');
  $(this).toggleClass('active');

  if ($('.sidebar').hasClass('active')) {
    $(this).find('i').addClass('fa-close');
    $(this).find('i').removeClass('fa-bars');
  } else {
    $(this).find('i').addClass('fa-bars');
    $(this).find('i').removeClass('fa-close');
  }
});

// Add hover feedback on menu
$('#menu-action').hover(function() {
    $('.sidebar').toggleClass('hovered');
});