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
seajs.use(['$', 'arale/overlay/0.9.13/overlay'], function($, Overlay) {
  var input = $('#input'),
    console = $('#console'),
    overlay = $('#overlay');

  var ol = Overlay.extend({
    attrs: {
      trigger: null,
      v: 0
    },

    events: {
      click: 'clickEvent',
      mousedown: 'mousedownEvent'
    },

    clickEvent: function() {
      log('input click');
    },

    setup: function() {
      var that = this,
        trigger = this.get('trigger');
      trigger.focus(function() {
        that.show();
      });

      this.set('align', {
        selfXY: [0, 0],
        baseElement: trigger,
        baseXY: [0, '100%']
      })
    },

    clickEvent: function() {
      log('input click');
      this.set('v', 1);
    },

    mousedownEvent: function() {
      log('input mousedown');
      this.set('v', 1);
    },

    onRenderV: function(val){
      console.log(val)
    }
  });

  input.focus(function() {
    log('input focus');
    overlay.show();
  }).blur(function() {
    log('input blur');
  });

  new ol({
    trigger: input,
    element: overlay
  })
  
  function log(txt) {
    $('<div>' + txt + '</div>').appendTo(console);
  }
});
</script>
