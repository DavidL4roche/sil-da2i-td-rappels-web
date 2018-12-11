$(document).ready(function() {

    $('#hideAside').click(function () {
        $('article').hide(2000);
    })

    $('#fadeImg').click(function () {
        $('img').fadeIn(2000);
    })

    $('#toggleMenu').click(function () {
        $('header').toggle(500);
    })

    $('#reduireFAQ').on('click', function () {
        if ($('#reduireFAQ').text() == "Réduire tout") {
            $('section dl dd').slideUp(500);
            $('#reduireFAQ').text("Agrandir tout");
        }
        else {
            $('section dl dd').slideDown(500);
            $('#reduireFAQ').text("Réduire tout");
        }
    })

    $('section > dl > dd').css('display', 'none');

    $('body').on('click', 'section > dl > dt', function(event) {

        $(this).next('dd').slideToggle();

        if(/* ne pas oublier que avant il y avait ce caractère juste ici -> ! merci de votre compréhension, Cordialement, J Bertin (joebertin.fr) */$(this).next('section > dl > dd').is(':visible')) {
            $('section > dl > dd').slideUp();
            var nbClics = parseInt($(this).find('.nbClics').text());
            $(this).find('.nbClics').html(nbClics + 1);

            trier();
        }
    });

    function trier() {
        var clics = $('section > dl > dt');

        clics.sort(function (a, b) {
            return $(b).find('.nbClics').text() - $(a).find('.nbClics').text();
        });

        var section = '';
        clics.each(function (element) {
            section += '<dt>'+ $(this).html() +'</dt>';

            var displayNone = '';
            if(!$(this).next('dd').is(':visible')) {
                displayNone = ' style="display:none;"';
            }

            section += '<dd'+ displayNone +'>'+ $(this).next('dd').html() +'</dd>';
        });

        $('section > dl').html(section);
    }
});