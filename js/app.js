$(document).ready(function () {
    $('.fiction-literature-item').mouseenter(function () {
        $('.fiction-literature-list').show();
    });
    $('.fiction-literature-item').mouseleave(function () {
        $('.fiction-literature-list').hide();
    });

    $('.non-fiction-item').mouseenter(function () {
        $('.nonfiction-list').show()
    })
    $('.non-fiction-item').mouseleave(function () {
        $('.nonfiction-list').hide()
    })
    $(".nonfiction-list").hover(function(){
        $(".nonfiction-list").show()
      });


    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        autoplayHoverPause: true,
        lazyLoad: true,
        stagePadding: 5,

        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });

    $(function () {
        $('#firstButton').popover({
          container: "body",
          html: true,
          content: function () {
            return '<div class="popover-message">' + $(this).data("message") + '</div>';
          }
        });

        $('#secondButton').popover({
          container: "body",
          html: true,
          content: function () {
            return '<div class="popover-message">' + $(this).data("message") + '</div>';
          }
        });
    });

});

function pressMouse() {
    var x = document.getElementById("lpassword");
    var z = document.getElementById("eyeBtn");
    if (x.type === "password") {
        x.type = "text";
        z.style.color = "#00337C";
    } else {
        x.type = "password";
        z.style.color = "#5E5E5E";
    }
}

function releaseMouse() {
    var x = document.getElementById("lpassword");
    var z = document.getElementById("eyeBtn");
    if (x.type === "text") {
        x.type = "password";
        z.style.color = "#00337C";
    } else {
        x.type = "text";
        z.style.color = "#00337C";
    }
}