<?php
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once ($root . '/model/model.php');
?>
<div  class="container">
<div  class="row">
<div class="container osnova-test" style="text-align:center;">
<span style="font-weight:600;">Сортировка:</span>
<a  href="#" data-option="id" id="id"  onclick="myFunction(this);">Сбросить</a>
</div>
</div>
<table class="table">
  <thead>
    <tr>
     <th scope="col">Имя 
		 <a href="#" data-option="nameu" id="nameu" onclick="myFunction(this);"><i class="fas fa-arrow-down"></i></a> 
		 <a href="#" data-option="namev" class="" id="namev" onclick="myFunction(this);"><i class="fas fa-arrow-up"></i></a>
	 </th>
     <th scope="col">E-mail
		<a href="#" data-option="emailu"  id="emailu" onclick="myFunction(this);"><i class="fas fa-arrow-down"></i></a> 
		<a href="#" data-option="emailv"  id="emailv" onclick="myFunction(this);"><i class="fas fa-arrow-up"></i></a>
	</th>
     <th scope="col">Текст задачи</th>
     <th scope="col">Статус 
		<a href="#"  data-option="statusu"  id="statusu" onclick="myFunction(this);"><i class="fas fa-arrow-down"></i></a> 
		<a href="#" data-option="statusv"  id="statusv" onclick="myFunction(this);"><i class="fas fa-arrow-up"></i></a>
	</th>
	   <?php if (Auth\User::isAuthorized()):?>
	   <th scope="col">Редактирование</th>
	   <?php endif;?>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($data_jobs as $key => $post) { ?>
	
	<?php $pagination_start_key = (empty($_GET['PAGEN_1'])) ? '0' : ($_GET['PAGEN_1'] - 1) * $item_per_page; ?>
		<?php $pagination_finish_key = (empty($_GET['PAGEN_1'])) ? $item_per_page : ($_GET['PAGEN_1']) * $item_per_page; ?>

		<?php if ($key < $pagination_finish_key && $key >= $pagination_start_key) {?>
	<tr>
      <th scope="row"><?=$post['name'];?></th>
      <td><?=$post['email'];?></td>
      <td><?=$post['text'];?></td>
		<td> 
			<?php if (!empty($post['statusc'])) {
				echo '<span class="done"><i class="fas fa-check"></i> Выполнено</span>';
			}
				else {
					echo 'Не выполнено';
				}
				if (!empty($post['statused'])) {
				echo '<p style="font-size:12px;">Отредактировано администратором</p>';
			}
				?>
			
		</td>
	  <?php if (Auth\User::isAuthorized()):?>
	  <td><a href="/edit?id=<?php echo $post['id'];?>"><i class="fas fa-edit"></i> Изменить</a></td>
	   <?php endif;?>
    </tr>
	
	



  <?php }}?>
  
    

  </tbody>
</table>

	
		<div class="text-center">
			
				
					<ul class="pagination" style="justify-content: center;">
						<?php include './model/pagination.php';?>
					</ul>
				
			
		</div>
		
</div>
<script>

function myFunction(d) {
	var name = d.getAttribute("data-option");
	//alert(name);
	  $.ajax({
        type: "POST",
        url: "/model/session.php",
        data: ("name="+name),
        success : function(text){
            if (text == 'success'){
                formSuccess();
            } else {
				 
                formError();
                submitMSG(false,text);
            }
        }
    });

}

function activeEl() {
	
}

var d = document.getElementById("<?=$_SESSION['query_sql']?>");
d.classList.add("active");

function formSuccess(){
    window.location.reload(false); 

	
}
</script>
