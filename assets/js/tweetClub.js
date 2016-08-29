page=1;
$(document).ready(function(){
  // $(window).scroll(function(){
  //   if($(window).scrollTop() + $(window).height() == $(document).height()) {
  //     loadtweets(page);
  //     page++;
  //   }
  // });
  loadtweets();
});
function loadtweets(){
  var url='../api/tweets/user/'+id_club+'/'+page;
  $.ajax({
    url: url,
    beforeSend: function(){
      if(page==1){
        $('.feed').empty();
      }
      $('.tweet:last-child').html('');
      $('.feed').append("<div class='tweet'>"+
        "<p class='center loading'>Carregando tweets....</p>"+
      "</div>")
    },
    success: function data(response){
      $('.tweet:last-child').html('');
      $('.feed').append(response);
    }
  });
  page++;
  // $('.feed:last-child').load(url);
}
z='';
function tweetaction(tweet,action){
  var url='../api/tweet/'+action+'/'+tweet;
  console.log(action);
  $.ajax({
    url: url,
    beforeSend: function(){
      if(action=='like'){
        if($('[tweetid='+tweet+'] .tweet-options button.like span').hasClass('like')==true){
          $('[tweetid='+tweet+'] .tweet-options button.like span').addClass('like2');
          $('[tweetid='+tweet+'] .tweet-options button.like span').removeClass('like');
          var x = parseInt($('[tweetid='+tweet+'] .tweet-options button.like i').html());
          $('[tweetid='+tweet+'] .tweet-options button.like i').html(x+1);
        }else{
          $('[tweetid='+tweet+'] .tweet-options button.like span').removeClass('like2');
          $('[tweetid='+tweet+'] .tweet-options button.like span').addClass('like');
          var x = parseInt($('[tweetid='+tweet+'] .tweet-options button.like i').html());
          $('[tweetid='+tweet+'] .tweet-options button.like i').html(x-1);
        }
      }else if(action=='delete'){
        $('[tweetid='+tweet+']').empty();
      }else if(action=='retweet'){
        if($('[tweetid='+tweet+'] .tweet-options button.retweet span').hasClass('retweet')==true){
          $('[tweetid='+tweet+'] .tweet-options button.retweet span').addClass('retweet2');
          $('[tweetid='+tweet+'] .tweet-options button.retweet span').removeClass('retweet');
          var x = parseInt($('[tweetid='+tweet+'] .tweet-options button.like i').html());
          $('[tweetid='+tweet+'] .tweet-options button.retweet i').html(x);
        }else{
          $('[tweetid='+tweet+'] .tweet-options button.retweet span').removeClass('retweet2');
          $('[tweetid='+tweet+'] .tweet-options button.retweet span').addClass('retweet');
          $('[retweetid='+tweet+'] .tweet-options button.retweet span').removeClass('retweet2');
          $('[retweetid='+tweet+'] .tweet-options button.retweet span').addClass('retweet');
          var x = parseInt($('[retweetid='+tweet+'] .tweet-options button.retweet i').html());
          $('[retweetid='+tweet+'] .tweet-options button.retweet i').html(x-1);
        }
      }
    },
    success: function(data){
      console.log('success');
      console.log(data);
    },
    error:function(data){
      console.log('error');
      console.log(data);
    }
  });
}

function opentweet(id_tweet,page){
  var url='../api/tweet/'+id_tweet;

  $.ajax({
    url: url,
    beforeSend: function(){
      $('#modal_tweet').prop("checked",true);
    },
    success: function(data){
      console.log(data);
      $('.modal-tweet .modal-content .club-logo img').attr('src','../../../assets/img/logo/'+data.data.club_logo);
      $('.modal-tweet .modal-content .tweet-info').html(data.data.clubname+"<span class='date'>"+data.data.tweetdate+"</span>")
      $('.modal-tweet .modal-content .tweet-text').html(data.data.tweet);

    }
  });

}
function deletetweet(id_tweet){
  if(confirm('Delete?')){
    tweetaction(id_tweet,'delete');
  }
}

$('.club-stats ul li').each(function(){
  switch($(this).html()){
    case 'rec[4.5]':
    case 'rec[4.6]':
    case 'rec[4.7]':
    case 'rec[4.8]':
    case 'rec[4.9]':
      $(this).html("<span class='helper bg-dark'><img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
      "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
      "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
      "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
      "<img src='http://t.soccerleague.com.br/assets/img/halfstar.png' width='16px'></span>");
      break;

    case 'rec[4.4]':
    case 'rec[4.3]':
    case 'rec[4.2]':
    case 'rec[4.1]':
    case 'rec[4.0]':
    $(this).html("<span class='helper bg-dark'><img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
    "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
    "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
    "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
    "<img src='http://t.soccerleague.com.br/assets/img/blankstar.png' width='16px'></span>");
    break;
    case 'rec[nan]':
    $(this).html("<span class='helper bg-dark'><img src='http://t.soccerleague.com.br/assets/img/blankstar.png' width='16px'>"+
    "<img src='http://t.soccerleague.com.br/assets/img/blankstar.png' width='16px'>"+
    "<img src='http://t.soccerleague.com.br/assets/img/blankstar.png' width='16px'>"+
    "<img src='http://t.soccerleague.com.br/assets/img/blankstar.png' width='16px'>"+
    "<img src='http://t.soccerleague.com.br/assets/img/blankstar.png' width='16px'></span>");
    break;
  }
})
