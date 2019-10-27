<?php
include './model/edit.php';
if (empty($_GET['id']) || empty($task_data['id'])) {
?>
<div class="container">
	<span style="font-size:18px;">Ошибка! Задача не найдена. Перейдите на <a href="/">главную страницу</a>.</span>
</div>
<?php
	exit;
}




?>

<?php if (Auth\User::isAuthorized()):?>
<div class="container">
<div class="col-sm-6 col-sm-offset-3">
    <div class="well" style="margin-top: 10%;">
    <h3>Редактирование задачи №<?=$task_data['id'];?></h3>
    <form role="form" id="contactForm" data-toggle="validator" class="shake">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="name" class="h4">Имя</label>
                <input type="text" class="form-control" id="name" placeholder="Введите имя" required value="<?=$task_data['name'];?>">
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group col-sm-6">
                <label for="email" class="h4">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Введите email" required  value="<?=$task_data['email'];?>">
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="h4 ">Текст задачи</label>
            <textarea id="message" class="form-control" rows="5" placeholder="Введите текст задачи" required ><?=$task_data['text'];?></textarea>
            <div class="help-block with-errors"></div>
        </div>
		<div class="form-group">
		<!-- Default unchecked -->
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="defaultUnchecked" <?=$checked;?>>
			<label class="custom-control-label" for="defaultUnchecked">Выполнена</label>
		</div>
		
		 </div>
        <button type="submit" id="form-submit" class="btn btn-success btn-lg pull-right ">Отправить</button>
        <div id="msgSubmit" class="h3 text-center hidden"></div>
        <div class="clearfix"></div>
    </form>
    </div>
</div>
</div>
</body>
<script  type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/js/validator.min.js"></script>
<script>
$("#contactForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Ошибки в заполнении.");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});

	
function submitForm(){
    // Initiate Variables With Form Content
    var name = $("#name").val();
    var email = $("#email").val();
    var message = $("#message").val();
	var checkBox = document.getElementById("defaultUnchecked");
	if (checkBox.checked == true){
     var checked = '1';
  } else {
         var checked = '0';
  }
	var id = <?=$task_data['id'];?>;
	var session = <?=$_SESSION["user_id"];?>;
    $.ajax({
        type: "POST",
        url: "/model/form-update.php",
        data: "name=" + name + "&email=" + email + "&message=" + message + "&id=" + id + "&session=" + session + "&checked=" + checked,
        success : function(text){
            if (text == "success"){
                formSuccess();
            } else {
                formError();
                submitMSG(false,text);
            }
        }
    });
}

function formSuccess(){
    $("#contactForm")[0].reset();
	 window.location.reload(false); 
    submitMSG(true, "Задача успешно отредактирована!")

}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}
</script>

<?php 

else:?>
<div class="container">
<form class="form-signin ajax form-group" method="post" action="./ajax.php">
        <div class="main-error alert alert-error hide"></div>

        <h2 class="form-signin-heading">Для доступа к редактированию необходима авторизация</h2>
		<div class="form-group" style="width: 19%;">
        <input name="username" type="text" class="input-block-level form-control" placeholder="Логин" autofocus>
		</div>
		<div class="form-group">
        <input name="password" type="password" class="input-block-level form-control" placeholder="Пароль"  style="width: 19%;">
		</div>
        <label class="checkbox">
          <input name="remember-me" type="checkbox" value="remember-me" checked> Запомнить меня
        </label>
		<div class="form-group" style="width: 19%;">
        <input type="hidden" name="act" value="login">
        <button class="btn btn-large btn-primary" type="submit">Войти</button>
		</div>
    
      </form>
</div>
<?php endif;?>