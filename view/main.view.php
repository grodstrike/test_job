<?php
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once ($root . '/model/model.php');
?>
<div  class="row">
<div class="container" style="text-align:center;">
<span style="font-weight:600;">Сортировка:</span> Имя 
<a href="#" data-option="nameu" onclick="myFunction(this);">По уб. ↓</a> 
<a href="#" data-option="namev" onclick="myFunction(this);">По возр. ↑</a> • E-mail
<a href="#" data-option="emailu" onclick="myFunction(this);">По уб. ↓</a> 
<a href="#" data-option="emailv" onclick="myFunction(this);">По возр. ↑</a> • Статус
<a href="#"  data-option="statusu" onclick="myFunction(this);">По уб. ↓</a> 
<a href="#" data-option="statusv" onclick="myFunction(this);">По возр. ↑</a> • 
<a  href="#" data-option="id" onclick="myFunction(this);">Сбросить</a>
</div>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Имя</th>
      <th scope="col">E-mail</th>
      <th scope="col">Текст задачи</th>
      <th scope="col">Статус</th>
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
				echo 'Выполнено';
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

function formSuccess(){
    window.location.reload(false); 

}
</script>
