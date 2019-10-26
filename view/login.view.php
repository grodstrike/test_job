<div class="container">

      <?php if (Auth\User::isAuthorized()): ?>
    
      <h1>Добро пожаловать!</h1>

      <form class="ajax" method="post" action="./ajax.php">
          <input type="hidden" name="act" value="logout">
          <div class="form-actions">
              <button class="btn btn-large btn-primary" type="submit">Выйти</button>
          </div>
      </form>

      <?php else: ?>
	  


      <form class="form-signin ajax form-group" method="post" action="./ajax.php">
        <div class="main-error alert alert-error hide"></div>

        <h2 class="form-signin-heading">Пожалуйста, войдите</h2>
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

      <?php endif; ?>

    </div> <!-- /container -->


