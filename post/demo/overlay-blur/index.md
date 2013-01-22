# keycode

- template: demo.html

----------------

<style>
#overlay, #console {border: 1px solid #ccc;}
#console {float: right;width: 400px;}
</style>

<div id="console">
  <div>logging...</div>
</div>

mousedown > blur > click

<input id="input" type="text" value="" />


<div id="overlay" style="display:none">
overlay
</div>

<script type="text/javascript">
seajs.use(['$', 'arale/position/1.0.0/position'], function($, Position) {
  var input = $('#input'),
    console = $('#console'),
    overlay = $('#overlay');
  input.focus(function() {
    Position.pin(overlay, {element:input, x: 0, y: '100%'});
    overlay.show();
    log('input focus');
  }).blur(function() {
    log('input blur');
  });
  
  overlay.click(function() {
    log('overlay click');
    overlay.hide();
  }).mousedown(function() {
    log('overlay mousedown');
  });
  
  function log(txt) {
    $('<div>' + txt + '</div>').appendTo(console);
  }
});
</script>
