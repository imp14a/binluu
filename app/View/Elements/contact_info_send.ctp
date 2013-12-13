
<?php 

echo $this->Html->css('binluu.login');
echo $this->Html->css('binluu.adviser.contact.css'); 

?>
<style>
    .title{
        width: 250px;
        display: inline-block;
        text-align: center;
    }
    .ok{
        background-image: url('/img/information_sent.png');
        background-position: center center;
        width: 100%;
        height: 100px;
        display: inline-block;
        margin-top: 100px;
        background-repeat: no-repeat;
    }
</style>
<div class="concatContent">
	<div class="mainImage" ></div>
	<div class="information">
            <div class="background"></div>
            <div class="detail"></div>
		<div class="ok"></div>
		<span class="title" style="margin-top: 40px;">Su Mensaje se ha enviado exitosamente</span>
		<span class="title" style="margin-top: 20px;">En breve nos pondremos en contacto.</span>
	</div>
</div>