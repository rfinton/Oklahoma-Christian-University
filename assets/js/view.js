function autoAdjust() {
  if(location.href.search('werhome.html') > 0) {
    $('td.desc, td.icons, .icon, .icon-clicked').css('height', document.querySelector('.icon img').clientWidth + 'px');
    
    $('.svg-object').attr('width', ($('.header').outerWidth() * 0.7) + 'px');
    $('.svg-object').attr('height', (($('.header').outerWidth() * 0.7) / 2.32) + 'px');
    
    $('.svg-object').css({
      marginLeft: (($('.header').outerWidth() * 0.3) / 2) + 'px',
      marginTop: ($('.header').outerHeight() * 0.3) + 'px'
    });

    $('#hoc-text-mobile').css('margin-top', ($('.header').outerHeight() * 0.5) + 'px');
  }
};

function showMobileText() {
  if(location.href.search('werhome.html') > 0) {
    $('#hoc-text-mobile').velocity({ blur: 20 }, { complete: function() {
      $('#hoc-text-mobile').velocity('fadeIn', 500, function() {
        $('#hoc-text-mobile').velocity({ blur: 0 }, { duration: 500 });
      });
    }});
  }
}

function showText() {
  if(location.href.search('werhome.html') > 0) {
    var s = Snap('svg');
    var filter = Snap('#blurMe');
    var gauss = Snap('#gauss');

    function unBlur() {
      $('svg').velocity('fadeIn', 1000, function() {
        Snap.animate(10, 0, function(value) {
          gauss.attr({ stdDeviation: value + ' ' + value });
        }, 500);
      });
    };

    unBlur();
  }
}

function parseFormResp(str) {
  var answers = [
    "<li>I\'m excited to be close to Oklahoma City so I can live a \"big\" life.</li>",
    "<li>I want to be part of an athletic team and roll with Ike, the mascot.</li>",
    "<li>It\'s great you have a spiritual life component. It\'s part of who I am.</li>",
    "<li>I\'m considering an internship at some point. You guys have a city booming with opportunity.</li>",
    "<li>I want to be challenged academically. Love that you are among the best in the west!</li>",
    "<li>\"OC is home\" means something to me. It\'s important that I matter during the next four years of college.</li>"
  ];

  var list = str.split(",");
  var el = document.querySelector('#selections');
  var html = '';

  for(var i = 0; i < list.length; i++) {
    if(list[i] == 'location')
      html = html + answers[0];
    if(list[i] == 'team')
      html = html + answers[1];
    if(list[i] == 'spiritual')
      html = html + answers[2];
    if(list[i] == 'internship')
      html = html + answers[3];
    if(list[i] == 'academics')
      html = html + answers[4];
    if(list[i] == 'community')
      html = html + answers[5];
  }

  el.innerHTML = "<ul>" + html + "</ul>";
}