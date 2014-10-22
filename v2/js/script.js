// var app = new Backbone.Marionette.Application();

var page = 'testV2',
    section;

var togglePage = function(){
  var hash = location.hash.slice(1) || "testV2";
  page = hash.split("?")[0];
  var paramsString = hash.split("?")[1] || "";
  var params = {};
  paramsString.split("&").forEach(function(paramString){
    var kv = paramString.split("=");
    params[kv[0]] = kv[1];
  });
  var lang = page.split('_')[1];
  if($('#'+page+'_template'))
    $('#content2').html($('#'+page+'_template').html());
  else
    $('#content2').html($('#'+page.split('_')[0]+'_template').html());
  // renderPane(page, params);
  // if($('#map').length && page == 'world') {
  //   $.get('world/world.html', function(data){
  //     $('#content2').html(data)
  //   })
  // }
}

var renderPane  = function(page, params) {
  switch (page) {
    case 'accueil':
      
      break;
    default:
      var lang = page.split('_')[1];
      if($('#'+page+'_template'))
        $('#content2').html($('#'+page+'_template').html());
      else
        $('#content2').html($('#'+page.split('_')[0]+'_template').html());
      break;
  }
};
$(document).ready(function(){
  togglePage();
});
$(window).on('hashchange',function(){
  togglePage();
});

function upHeight()
{
    var colonne = $(window).height() - $("#onglets").height();
    $('.colonne').css("height", colonne + "px");
    $('#bas').css("height", colonne + "px");
}
upHeight();
window.onresize = upHeight;

if(!sessionStorage.getItem('autorisation'))
  sessionStorage.setItem('autorisation',0);

$('#editer').click(function (event){
  if (parseInt(sessionStorage.autorisation) == 0){
    if( prompt("Mot de passe :", "").toLowerCase() =="wheels") {
      sessionStorage.autorisation = 1;
      if(!$('#nouveau').length) {
        $('#content2').prepend(
          $('<button>',{
            id: 'nouveau',
            onclick: 'nouveau();',
            text: 'Ecrire un nouvel article'
          })
        )
      }
    }
  }
  else
  {
    sessionStorage.autorisation = 0;
    if($('#nouveau').length) $('#nouveau').remove();
  }
});

function redact(article) {
  if(parseInt(sessionStorage.autorisation)) {
    $(article).parent().find('button').css('display', 'inline-block');
    $(article).redactor({ focus: true });
  }
}


function nouveau(id) {
  var dernier = $.map($('.id'), function (e) { return $(e).attr('id'); }).sort();

  if (dernier.length) {
    dernier_id = parseInt(dernier.pop()) + 1;
  } else {
    dernier_id = 0;
  }

  $("#nouveau").after(
    $('<div>',{class:'article_container'}).html(
      $('<div>',{
        class:'article',
        id: dernier_id,
        'data-page': page,
        onclick: 'redact(this);'
      }).html('<h1>Titre</h1><p>Paragraphe</p>')
    ).append(
      $('<button>',{
        class:'id',
        onclick: 'postSave(this);',
        text: 'Sauvegarder',
        style:'display: inline-block;'
      })
    ).append(
      $('<button>',{
        class:'id',
        text:'Effacer cet article',
        style:'display: inline-block;',
        onclick: 'effacer(this);'
      })
    )
  )
  $('#nouveau').next().find('.article').redactor();

}
function effacer(button) {
  var id = parseInt($(button).parent().find('.article').attr('id'));
  var articlePage = parseInt($(button).parent().find('.article').attr('data-page'));
  console.log(button,id);

  var json = { "id": id, "page": articlePage };

  $.ajax({
    url: "delete.php",
    type: "post",
    data: json,
    // dataType : "json",
    cache: false,
    error: function (resultat, statut, erreur) {
      console.log(resultat);
      console.log(statut);
      console.log(erreur);
      alert("Ca n'a pas marché, essaie une nouvelle fois");
    },
    success: function (data) {
      alert("Les paroles s'envolent");
      $(id).parent().html('');
    }
  });
}

function postSave(button) {
  $('.article.redactor_editor').redactor('destroy');
  $(button).parent().find('button').css('display', 'none');

  var jsonHtml = $(button).parent().find(".article").html();
  var jsonId = $(button).parent().find(".article").attr('id');
  var jsonPage = $(button).parent().find(".article").attr('data-page');

  json = { "article": jsonHtml, "id": jsonId, "page": jsonPage };
  $.ajax({
    url: "save.php",
    type: "post",
    data: json,
    cache: false,
    error: function (resultat, statut, erreur) {
      console.log(resultat,statut,erreur);
      alert("Ca n'a pas marché, essaie une nouvelle fois");
    },
    success: function (data) {
      console.log(data);
      alert('Les écrits restent');
      //$('body').load('index.php?page=' + $('#page').html() + '&query=refresh');
    }
  });
}

// function scroll(link) {
//   console.log(link)
//   $('html, body').animate({
//       scrollTop: $($.attr(this, 'href')).offset().top
//     },
//     300
//   );
// }

// $('a').click(scroll);