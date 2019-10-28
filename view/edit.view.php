<?php
if (empty($_GET['id']) || empty($task_data['id'])) {
?>
<div class="container">
	<span style="font-size:18px;">Ошибка! Задача не найдена. Перейдите на <a href="/">главную страницу</a>.</span>
</div>
<?php
exit;}
?>
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
			<div class="created-edit">
				<span style="font-weight:500"> Время создания:</span> <?=$task_data['date'];?>
				<?php if (!empty($task_data['statused'])):?>
					<p><span style="font-weight:500">Отредактировано:</span> <?=$task_data['date_edit'];?>
					
				<?php endif;?>
				<p><span class="btn btn-success btn-sm pull-right delete-job" style="cursor:pointer;background-color: #ff1a1a; border-color: #a72828;float:right;">Удалить задачу</span><div class="gotovo" id="gotovo"></div></div>
			</div>
		</div>
		
		 </div>
		 <div class="form-group">
			<button type="submit" id="form-submit" class="btn btn-success btn-lg pull-right ">Отправить</button>
			
		</div>
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

jQuery(".delete-job").click(function() {
	console.log( "mod-deleted!" );
	var id = <?php echo $task_data['id'];?>;
    jQuery.ajax({
		
        url: '/model/del-job.php',
        type: 'POST',
        data: {"id":id},
		  beforeSend: function(html) { // запустится до вызова запроса
                    $(".delete-job").hide("slow");
					var ele = document.getElementById('gotovo');
	ele.innerHTML = 'Ждите..<img src="default.gif" id="spin">';
	
	ele.style.cursor = 'not-allowed';
	ele.disabled = true;
				
               },
               success: function(html){ // запустится после получения результатов
                   
					 $(".gotovo").show("slow");
					var ele = document.getElementById('gotovo');
	ele.innerHTML = '<span style="font-weight:500;font-size:14px;">Удалено! Вы перейдете на главную страницу через 5 секунд...</span>';
	ele.style.cursor = 'pointer';
	ele.disabled = false;
	setTimeout(function(){
            window.location.href = '/';
         }, 5000);
              }
    });
	
	
	
});

</script>