autorisation = $('#session').html();

function upHeight()
{
    var colonne = $(window).height() - $("#onglets").height();
    $('.colonne').css("height", colonne + "px");
    $('#bas').css("height", colonne + "px");
}
upHeight();

window.onresize = upHeight;

$('#editer').click(
    function (event)
    {
        if (autorisation == "non")
        {
            var x = prompt("Mot de passe :", "");
            x = x.toLowerCase();
        }
        else
        {
            x = "";
        }

        var datax = { "password": x, "autorisation": autorisation };

        $.ajax
        ({
            url: "auth.php",
            type: "post",
            data: datax,
            // dataType : "json",
            cache: false,
            error: function (resultat, statut, erreur)
            {
                console.log(resultat);
                console.log(statut);
                console.log(erreur);
                alert("Ca n'a pas marché, essaie une nouvelle fois");
            },

            success: function (data)
            {
                alert(data);
                autorisation = data;
                globalID = requestAnimationFrame(repeatOften);
            }
        });
    }
);

$('.article').click(
    function (event)
    {
        if (autorisation == "oui")
        {
            $(this).parent().find('.id').css('display', 'inline-block');
            $(this).redactor(
            {
                focus: true
            }
        );
        }
    }
);

$('utf').blur(
    function (event)
    {
        $(this).redactor('destroy');
    }
);

function nouveau(id)
{
    var dernier = $.map($('.id'), function (e) { return $(e).attr('id'); }).sort();

    if (dernier.length)
    {
        dernier_id = parseInt(dernier.pop()) + 1;
    }
    else
    {
        dernier_id = 0;
    }

    var nouveau = $("#nouveau").before($("<div class='article_container'><div class='article'><h1>Titre</h1><p>Paragraphe</p></div><button class='id' id='" + dernier_id + "' onclick='postSave(this);'>Sauvegarder</button><button class='id' id='" + dernier_id + "' onclick='effacer(this);'>Supprimer cet article</button></div><script type='text/javascript'>$('.article').click(function(event){$(this).parent().find('.id').css('display','inline-block');$(this).redactor({focus:true});});"));
    $(".article_container").last().children().first().redactor();
    $(".article_container").last().find('.id').css('display', 'inline-block');

}
function effacer(id)
{
    var jsonId = id.id;
    var jsonPage = $('#page').html();

    var json = { "id": jsonId, "page": jsonPage };
    //var json = {"id" : '0', "page" : 'accueil'};

    $.ajax
    ({
        url: "delete.php",
        type: "post",
        data: json,
        // dataType : "json",
        cache: false,
        error: function (resultat, statut, erreur)
        {
            console.log(resultat);
            console.log(statut);
            console.log(erreur);
            alert("Ca n'a pas marché, essaie une nouvelle fois");
        },

        success: function (data)
        {
            alert("Les paroles s'envolent");
            $(id).parent().html('');
        }
    });
}

function postSave(id)
{
    $('.article.redactor_editor').redactor('destroy');
    $(".article_container").last().find('.id').css('display', 'none');

    var jsonHtml = $(id).parent().find(".article").html();
    var jsonId = id.id;
    var jsonPage = $('#page').html();

    jsonne = { "article": jsonHtml, "id": jsonId, "page": jsonPage };
    $.ajax
    ({
        url: "save.php",
        type: "post",
        data: jsonne,
        //dataType: 'json',
        cache: false,
        error: function (resultat, statut, erreur)
        {
            console.log(resultat);
            console.log(statut);
            console.log(erreur);
            alert("Ca n'a pas marché, essaie une nouvelle fois");
        },
        success: function (data)
        {
            alert('Les écrits restent');
            //$('body').load('index.php?page=' + $('#page').html() + '&query=refresh');
        }
    });
}

$('a').click(function ()
{
    $('html, body').animate(
        {
            scrollTop: $($.attr(this, 'href')).offset().top
        },
        300
    );
    return false;
});