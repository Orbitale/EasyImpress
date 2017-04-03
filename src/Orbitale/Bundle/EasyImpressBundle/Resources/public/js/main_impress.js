(function ($, d, w) {

    $('.fallback-message').hide();

    w.addEventListener('impress:stepenter', function (event) {
        for (var i= 0, a = d.querySelectorAll('.step.leaving'), l = a.length; i < l; i++) {
            a[i].classList.remove('leaving');
        }
        if (event.target.id === 'overview') {
            d.getElementById('impress').classList.add('overview');
        } else {
            d.getElementById('impress').classList.remove('overview');
        }
    });
    w.addEventListener('impress:stepleave', function (event) {
        event.target.classList.add('leaving');
    });

    var impressElement = impress();
    impressElement.init();

    $('#left_arrow_clickable,.impress-button-prev').on('click',function(){impressElement.prev();});
    $('#right_arrow_clickable,.impress-button-next').on('click',function(){impressElement.next();});

})(jQuery, document, window);
