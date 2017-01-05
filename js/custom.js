$(function ($) {
                
    // Navigation scrolls
    $('.navbar-nav li a').bind('click', function(event) {
        $('.navbar-nav li').removeClass('active');
        $(this).closest('li').addClass('active');
        var $anchor = $(this);
        var nav = $($anchor.attr('href'));
        if (nav.length) {
        $('html, body').stop().animate({				
            scrollTop: $($anchor.attr('href')).offset().top				
        }, 1500, 'easeInOutExpo');
        
        event.preventDefault();
        }
    });
    
    
    // Add smooth scrolling to all links in navbar
    $(".navbar a, a.mouse-hover, .overlay-detail a").on('click', function(event) {
        event.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
            scrollTop: $(hash).offset().top
        }, 900, function(){
            window.location.hash = hash;
        });
    });
});

$(function ($) {
        var $contactForm = $('#contact-form');
        $contactForm.submit(function (e) {
            e.preventDefault();
            $.ajax({
            method: 'POST',
            url: 'contact.php',
            async: true,
            data: $(this).serialize(),
            success: function (data) {
                $("#message").wrap('' +
                    '<div class="alert alert-success alert-dismissable" role="alert">' +
                    'Message sent' +
                    '<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>' +
                    '</div>'
                );
                $contactForm.trigger("reset");
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});

window.onload = function () {
    $('#myModal').modal('show');
};