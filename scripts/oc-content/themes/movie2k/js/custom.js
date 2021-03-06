$(document).on("click",".vote",function(event){event.preventDefault();var id=$(this).attr("id");var name=$(this).attr("name");var datavote='id='+id;var parent=$(this);if(name=='up')
{$(this).fadeIn(200).html('<img src="/content/themes/movie4k/images/dot.png" align="absmiddle">');$.ajax({type:"POST",url:"/content/themes/movie4k/index/up_vote.php",data:datavote,cache:false,success:function(html){parent.html(html);}});}
else
{$(this).fadeIn(200).html('<img src="/content/themes/movie4k/images/dot.png" align="absmiddle">');$.ajax({type:"POST",url:"/content/themes/movie4k/index/down_vote.php",data:datavote,cache:false,success:function(html){parent.html(html);}});}
return false;});