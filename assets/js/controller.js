var formResp = [];

$(document).ready(function() {
  $('td').click(function() {
    var data = this.dataset.resp;

    for(var i = 0; i < formResp.length; i++) {
      if(data == formResp[i]) {
        formResp.splice(i,1);
        return;
      }
    }

    formResp.push(data);
  });

  $('#ready, #visit').click(function() {
    if(formResp.length == 0) {
      alert('Please choose an item of interest.');
    } else {
      $('input[name=submitaction]').val(this.dataset.action);
      $('input[name=form_resp]').val(formResp.toString());
      $('#form').submit();
    }
  });

  $('.icon-clicked').click(function() {
    if(this.style.opacity == 0) {
      this.style.opacity = 1;
    } else {
      this.style.opacity = 0;
    }
  });
});