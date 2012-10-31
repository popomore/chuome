# Danbo

- template: demo.html

----------------


`````css
.danbo {
	display: block;
	position: relative;	
	background: #E2B21A;
	margin-bottom: 10px;
}
.danbo-eye{
	display: block;
	position: absolute;
	width: 12%;
	height: 18%;
	background: #000;
	border-radius: 100%;
	top: 30%;
}
.danbo-lefteye{
	left: 25%;	
}
.danbo-righteye{
	right:25%;
}
.danbo-mouth{
	display: block;
	position: absolute;
	left: 50%;
	top: 65%;
	width: 0;
	height: 0;
}


.danbo-16{
	width: 16px;
	height: 9px;
}
.danbo-16 .danbo-mouth{
	border-left: 1px solid transparent;
	border-right: 1px solid transparent;
	border-bottom: 1.5px solid black;
	margin-left: -1px;
}
.danbo-32{
	width: 32px;
	height: 18px;
}
.danbo-32 .danbo-mouth{
	border-left: 2px solid transparent;
	border-right: 2px solid transparent;
	border-bottom: 3px solid black;
	margin-left: -2px;
}
.danbo-64{
	width: 64px;
	height: 36px;
}
.danbo-64 .danbo-mouth{
	border-left: 4px solid transparent;
	border-right: 4px solid transparent;
	border-bottom: 6px solid black;
	margin-left: -4px;
}
.danbo-128{
	width: 128px;
	height: 72px;
}
.danbo-128 .danbo-mouth{
	border-left: 8px solid transparent;
	border-right: 8px solid transparent;
	border-bottom: 12px solid black;
	margin-left: -8px;
}
.danbo-256{
	width: 256px;
	height: 144px;
}
.danbo-256 .danbo-mouth{
	border-left: 16px solid transparent;
	border-right: 16px solid transparent;
	border-bottom: 24px solid black;
	margin-left: -16px;
}
.danbo-512{
	width: 512px;
	height: 288px;
}
.danbo-512 .danbo-mouth{
	border-left: 32px solid transparent;
	border-right: 32px solid transparent;
	border-bottom: 48px solid black;
	margin-left: -32px;
}
`````

````html
<div class="danbo danbo-16">
	<span class="danbo-eye danbo-lefteye"></span>
	<span class="danbo-eye danbo-righteye"></span>
	<span class="danbo-mouth"></span>
</div>

<div class="danbo danbo-32">
	<span class="danbo-eye danbo-lefteye"></span>
	<span class="danbo-eye danbo-righteye"></span>
	<span class="danbo-mouth"></span>
</div>

<div class="danbo danbo-64">
	<span class="danbo-eye danbo-lefteye"></span>
	<span class="danbo-eye danbo-righteye"></span>
	<span class="danbo-mouth"></span>
</div>

<div class="danbo danbo-128">
	<span class="danbo-eye danbo-lefteye"></span>
	<span class="danbo-eye danbo-righteye"></span>
	<span class="danbo-mouth"></span>
</div>

<div class="danbo danbo-256">
	<span class="danbo-eye danbo-lefteye"></span>
	<span class="danbo-eye danbo-righteye"></span>
	<span class="danbo-mouth"></span>
</div>

<div class="danbo danbo-512">
	<span class="danbo-eye danbo-lefteye"></span>
	<span class="danbo-eye danbo-righteye"></span>
	<span class="danbo-mouth"></span>
</div>
````