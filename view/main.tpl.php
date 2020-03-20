<section class="login-block">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center" id="actionLoginName">
				<? 
				if( $data['admin'] == true && $request[0]=='edit'){echo "Редактировать задачу";}else{echo "Добавить задачу";}
				?>
				</h2>
				<form class="form" action="/" method="POST">
					<div class="form-group">
						<label class="text-uppercase">Имя</label>
						<input required type="text" name="name" class="form-control" placeholder="" value="<?=$data['task']['name'] ?>">
					</div>

					<div class="form-group">
						<label class="text-uppercase">E-Мейл</label>
						<input required type="text" name="email" class="form-control" pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$" placeholder="" value="<?=$data['task']['email'] ?>">
					</div>

					<div class="form-group">
						<label  class="text-uppercase">Текст задачи</label>
						<input required type="text" name="text" class="form-control" placeholder=""  value="<?=$data['task']['text'] ?>">
					</div>

					<? if($data['admin'] == true){ ?>
						<div class="form-check">
						<label class="form-check-label">
						<? $checked = '';if ( $data['task']['status'] ) $checked = 'checked'; ?>
						<input id="actionLogin" name="status" type="checkbox" <?=$checked ?> class="form-check-input">
						Отметка о выполнении задачи
						</label>
					</div>
					<input name="id" type="hidden" value="<?=$data['task']['id'] ?>">
					<? } ?>
					  
					<div class="form-check">
					 <button id="save" type="submit" name="action" value="Отправить" class="btn btn-login float-right">Отправить</button>
					</div>
					<br><br>
				</form>
			</div>
		</div>
	</div>
</section>


<table width='100%'>
	<tr>
		<th>Имя пользователя</th>
		<th>Е-Мейл</th>
		<th>Текст задачи</th>
		<th>Статус</th>
		<? if($data['admin'] == true){echo "<th>Админ</th>";} ?>
	</tr>
	<? foreach ($data['query'] as $Row) { ?>
	<tr>
		<td><?= $Row['name'] ?></td>
		<td><?= $Row['email'] ?></td>
		<td><?= $Row['text']  ?></td>
		<td><?= $Row['status_text']  ?></td>
		<? if($data['admin'] == true){echo "<td><a href=/edit/$Row[id]>изменить</a></td>";} ?>
	</tr>
	<? } ?>
</table>
<br>
<?= $data['paginator'] ?>
