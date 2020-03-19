$(function() {
	$('#save').click(function() { 		//при нажатии на кнопку с id="save"
		var formValid = true;			//переменная formValid
		$('input').each(function() {	//перебрать все элементы управления input 
			var formGroup = $(this).parents('.form-group');	//найти предков, которые имеют класс .form-group

			if (this.checkValidity()) {		//для валидации данных используем HTML5 функцию
				formGroup.addClass('has-success').removeClass('has-error'); //добавить к formGroup класс .has-success
			} else {
				formGroup.addClass('has-error').removeClass('has-success');	//добавить к formGroup класс .has-error
				formValid = false;  			//отметить форму как невалидную
			}
		});
		if (formValid) {					//если форма валидна, то
		  $('#success-alert').removeClass('hidden'); //отобразить сообщение об успехе
		  alert('Выполнено');
		}
	});
});

function message(msg,title,btn){
	if(title !==''){
		$('#modalTitle').text(title);
	}
	$('#modalText').text(msg);
	$('#modalBtn').text(btn);
	$('#modal').show();
}

function modalOk(rez){
	$('#modal').hide();
	return rez;
}




