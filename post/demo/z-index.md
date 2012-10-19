# z-index bug

- template: demo.html

----------------


<style>
.block {
    width:200px;height:100px;
}
.color1{ background: #ccc; border:10px solid red; }
.color2{ background: #aaa; border:10px solid blue; }
.color3{ background: #999; border:10px solid green; }
.color4{ background: #666; border:10px solid yellow;}
.color5{ background: #777; border:10px solid orange;}
.color6{ background: #eee; border:10px solid brown;}
</style>

## 1. 顺序加载

层级按渲染顺序递增，子元素层级高于父元素

<div class="block color1">
    1
    <div style="width:100px;height:50px; margin:20px auto 0;" class="color2">2</div>
</div>
<div style="margin-top: -20px;" class="block color3">
    3
</div>

## 2. 设置 z-index

z-index 的层级高于顺序渲染，z-index 必须要设置 position。z-index 越大，层级越高

<div class="block color1">
    1 no position
    <div style="position:relative;z-index:0;width:100px;height:50px; margin:0 auto;" class="color2">
        2 z-index:1
    </div>
</div>
<div style="margin-top: -30px;" class="block color3">
    3 no position
</div>

## 3. z-index 为 0

auto == 0?

<div style="position:relative;top:10px;z-index:0;" class="block color1">
    1 z-index:0
</div>
<div style="position:relative;" class="block color2">
    2 z-index:auto
</div>
<div style="position:relative;z-index:0;top:-10px;" class="block color3">
    3 z-index:0;
</div>

## 4. z-index 为 -1

z-index:-1 可以隐藏

<div style="position:relative;top:10px;z-index:-1;" class="block color1">
    1 z-index:-1
</div>
<div class="block color2">
    2 no position
</div>

## 5. 拼爹的年代

<div style="position:relative;z-index:1;" class="block color1">
    1 z-index:1
    <div style="top: 40px;height: 50px;width: 120px;position:absolute;left: 30px;z-index:100;" class="block color2">
        2 z-index:100
    </div>
</div>
<div style="position:relative;top:-10px;z-index:10;" class="block color3">
    3 z-index:10
</div>


## 6. IE6,7 的 bug

<div style="position:relative;" class="block color1">
    1 z-index:auto
    <div style="top: 40px;height: 50px;width: 120px;position:absolute;left: 30px;z-index:2;" class="block color2">
        2 z-index:2
    </div>
</div>
<div style="position:relative;top:-10px;z-index:1;" class="block color3">
    3 z-index:1
</div>

## 7. 复杂一点的场景

<div style="position:relative;width:600px;height:600px;z-index:1;" class="block color1">
    1 z-index:1
    <div style="position:absolute;left:40px;top:40px;z-index:200;" class="block color2">
        2 z-index:200
    </div>
    <div style="position:absolute;top: 80px;left: 80px;z-index:300;" class="block color3">
        3 z-index:300
        <div style="position:absolute;top:-80px;left:120px;z-index:5;" class="block color4">
        4 z-index:5
        </div>
    </div>
</div>
<div style="position:relative;width: 500px;top:-490px;left:10px;z-index:100;" class="block color5">
    5 z-index:100
    <div style="position:absolute;top:60px;left:-10px;z-index:10;" class="block color6">
        6 z-index:10
    </div>
</div>

