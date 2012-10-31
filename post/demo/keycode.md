# keycode

- template: demo.html

----------------

<div style="background:#fff;">
    <input id="keyInput" type="text" value="" />
    
    <div id="keyupResult">keyup:</div>
    <div id="keydownResult">keydown:</div>
    <div id="keypressResult">keypress:</div>
</div>

<script>
var key = document.getElementById('keyInput');
var keyupResult = document.getElementById('keyupResult');
var keydownResult = document.getElementById('keydownResult');
var keypressResult = document.getElementById('keypressResult');

key.onkeyup = function(e) {
    keyupResult.innerHTML = log('keyup', e);
}

key.onkeydown = function(e) {
    keydownResult.innerHTML = log('keydown', e);
}

key.onkeypress = function(e) {
    keypressResult.innerHTML = log('keypress', e);
}

function log(type, e) {
    return type + 
        ': keyCode=' + e.keyCode +
        '; charCode=' + e.charCode +
        '; which=' + e.witch +
        ';<br> ctrlKey=' + e.ctrlKey +
        '; metaKey=' + e.metaKey +
        '; shiftKey=' + e.shiftKey +
        '; altKey=' + e.altKey;
}
</script>

## 结论

- keydown 和 keyup 事件返回的 charCode 均为 0
- keypress 的 keyCode 和 charCode 相同


## 辅助键

ctrlKey
metaKey
shiftKey
altKey

## webkit

- mac chrome 20.0.1132.57
- mac safari 6.0 (8536.25)

 | keyup<br>(keyCode) | keyup<br>(charCode) | keydown<br>(keyCode) | keydown<br>(charCode) | keypress<br>(keyCode) | keypress<br>(charCode)
--- | ------ | -------  | ---- | ---- | ---- | ----
delete | 8 | 0 | 8 | 0 | 不触发 | 不触发
tab | 9 | 0 | 9 | 0 | 不触发 | 不触发
enter | 13 | 0 | 13 | 0 | 13 | 13
left/right shift ⇧ | 16 | 0 | 16 | 0 | 不触发 | 不触发 
left control ⌃ | 17 | 0 | 17 | 0 | 不触发 | 不触发 
left/right option ⌥ | 18 | 0 | 18 | 0 | 不触发 | 不触发 
caps| 20<br>未选中触发 | 0 | 20<br>选中触发 | 0 | 不触发 | 不触发
esc | 27 | 0 | 27 | 0 | 不触发 | 不触发
space | 32 | 0 | 32 | 0 | 32 | 32 
left | 37 | 0 | 37 | 0 | 不触发 | 不触发 
top | 38 | 0 | 38 | 0 | 不触发 | 不触发 
right | 39 | 0 | 39 | 0 | 不触发 | 不触发 
bottom | 40 | 0 | 40 | 0 | 不触发 | 不触发 
0-9 | 48-57 | 0 | 48-57 | 0 | 48-57 | 48-57
A-Z | 65-90 | 0 | 65-90 | 0 | 65-90 | 65-90
a-z | 65-90 | 0 | 65-90 | 0 | 97-122 | 97-122
left command ⌘ | 91 | 0 | 91 | 0 | 不触发 | 不触发 
right command `⌘` | 93 | 0 | 93 | 0 | 不触发 | 不触发 
f1-f12 | 112-123 | 0 | 112-123 | 0 | 不触发 | 不触发
= | 187 | 0 | 187 | 0 | 61 | 61
, | 188 | 0 | 188 | 0 | 44 | 44
- | 189 | 0 | 189 | 0 | 45 | 45
. | 190 | 0 | 190 | 0 | 46 | 46
/ | 191 | 0 | 191 | 0 | 47 | 47
~ | 192 | 0 | 192 | 0 | 96 | 96
[ | 219 | 0 | 219 | 0 | 91 | 91
\ | 220 | 0 | 220 | 0 | 92 | 92
] | 221 | 0 | 221 | 0 | 93 | 93
fn | 不触发 | 不触发 | 不触发 | 不触发 | 不触发 | 不触发

## gecko

- mac firefox 14.0.1

 | keyup<br>(keyCode) | keyup<br>(charCode) | keydown<br>(keyCode) | keydown<br>(charCode) | keypress<br>(keyCode) | keypress<br>(charCode)
--- | ------ | -------  | ---- | ---- | ---- | ----
delete | 8 | 0 | 8 | 0 | 8 | 0
tab | 9 | 0 | 9 | 0 | 9 | 0
enter | 13 | 0 | 13 | 0 | 13 | 0
left/right shift ⇧ | 16 | 0 | 16 | 0 | 不触发 | 不触发 
left control ⌃ | 17 | 0 | 17 | 0 | 不触发 | 不触发 
left/right option ⌥ | 18 | 0 | 18 | 0 | 不触发 | 不触发 
caps| 不触发 | 不触发 | 20 | 0 | 不触发 | 不触发
esc | 27 | 0 | 27 | 0 | 27 | 0
space | 32 | 0 | 32 | 0 | 0 | 32 
left | 37 | 0 | 37 | 0 | 37 | 0
top | 38 | 0 | 38 | 0 | 38 | 0 
right | 39 | 0 | 39 | 0 | 39 | 0
bottom | 40 | 0 | 40 | 0 | 40 | 0
0-9 | 48-57 | 0 | 48-57 | 0 | 0 | 48-57
A-Z | 65-90 | 0 | 65-90 | 0 | 0 | 65-90
a-z | 65-90 | 0 | 65-90 | 0 | 0 | 97-122
left/right command ⌘ | 224 | 0 | 224 | 0 | 不触发 | 不触发 
f1-f12 | 112-123 | 0 | 112-123 | 0 | 112-123 | 0
= | 61 | 0 | 61 | 0 | 0 | 61
, | 188 | 0 | 188 | 0 | 0 | 44
- | 189 | 0 | 189 | 0 | 0 | 45
. | 190 | 0 | 190 | 0 | 0 | 46
/ | 191 | 0 | 191 | 0 | 0 | 47
~ | 192 | 0 | 192 | 0 | 0 | 96
[ | 219 | 0 | 219 | 0 | 0 | 91
\ | 220 | 0 | 220 | 0 | 0 | 92
] | 221 | 0 | 221 | 0 | 0 | 93
fn | 不触发 | 不触发 | 不触发 | 不触发 | 不触发 | 不触发


window

 | keyup<br>(keyCode) | keyup<br>(charCode) | keydown<br>(keyCode) | keydown<br>(charCode) | keypress<br>(keyCode) | keypress<br>(charCode)
--- | ------ | -------  | ---- | ---- | ---- | ----
backspace | 8 | 0 | 8 | 0 | 不触发 | 不触发
tab | 9 | 0 | 9 | 0 | 不触发 | 不触发
enter | 13 | 0 | 13 | 0 | 13 | 13
left/right shift ⇧ | 16 | 0 | 16 | 0 | 不触发 | 不触发 
left control ⌃ | 17 | 0 | 17 | 0 | 不触发 | 不触发 
left/right alt ⌥ | 18 | 0 | 18 | 0 | 不触发 | 不触发 
caps| 20 | 0 | 20 | 0 | 不触发 | 不触发
esc | 27 | 0 | 27 | 0 | 27 | 27
space | 32 | 0 | 32 | 0 | 32 | 32 
left | 37 | 0 | 37 | 0 | 不触发 | 不触发 
top | 38 | 0 | 38 | 0 | 不触发 | 不触发 
right | 39 | 0 | 39 | 0 | 不触发 | 不触发 
bottom | 40 | 0 | 40 | 0 | 不触发 | 不触发 
0-9 | 48-57 | 0 | 48-57 | 0 | 48-57 | 48-57
! | 49 | 0 | 49 | 0 | 33 | 33
@ | 50 | 0 | 50 | 0 | 64 | 64
# | 51 | 0 | 51 | 0 | 35 | 35
$ | 52 | 0 | 52 | 0 | 36 | 36
% | 53 | 0 | 53 | 0 | 37 | 37
^ | 54 | 0 | 54 | 0 | 94 | 94
& | 55 | 0 | 55 | 0 | 38 | 38
* | 56 | 0 | 56 | 0 | 42 | 42
( | 57 | 0 | 57 | 0 | 40 | 40
) | 48 | 0 | 48 | 0 | 41 | 41
A-Z | 65-90 | 0 | 65-90 | 0 | 65-90 | 65-90
a-z | 65-90 | 0 | 65-90 | 0 | 97-122 | 97-122
left win | 91 | 0 | 91 | 0 | 不触发 | 不触发
right win | 92 | 0 | 92 | 0 | 不触发 | 不触发
f1-f12 | 112-123 | 0 | 112-123 | 0 | 不触发 | 不触发
= | 187 | 0 | 187 | 0 | 61 | 61
, | 188 | 0 | 188 | 0 | 44 | 44
- | 189 | 0 | 189 | 0 | 45 | 45
. | 190 | 0 | 190 | 0 | 46 | 46
/ | 191 | 0 | 191 | 0 | 47 | 47
~ | 192 | 0 | 192 | 0 | 96 | 96
[ | 219 | 0 | 219 | 0 | 91 | 91
\ | 220 | 0 | 220 | 0 | 92 | 92
] | 221 | 0 | 221 | 0 | 93 | 93
insert | 45 | 0 | 45 | 0 | 不触发 | 不触发
home | 36 | 0 | 36 | 0 | 不触发 | 不触发
pageup | 33 | 0 | 33 | 0 | 不触发 | 不触发
pagedown | 34 | 0 | 34 | 0 | 不触发 | 不触发
delete | 46 | 0 | 46 | 0 | 不触发 | 不触发
end | 35 | 0 | 35 | 0 | 不触发 | 不触发
Num Lock | 144 | 0 | 144 | 0 | 不触发 | 不触发
Num 0-9 | 96-105 | 0 | 96-105 | 0 | 不触发 | 不触发
Num Del  | 35 | 0 | 35 | 0 | 不触发 | 不触发

Num Enter  | 35 | 0 | 35 | 0 | 不触发 | 不触发
 
Num + | 35 | 0 | 35 | 0 | 不触发 | 不触发

Num - | 35 | 0 | 35 | 0 | 不触发 | 不触发

Num * | 35 | 0 | 35 | 0 | 不触发 | 不触发

Num / | 35 | 0 | 35 | 0 | 不触发 | 不触发

