function update_info(valor, tipo) {
	$.ajax({
			type: 'POST',
			// async: false,
			dataType: 'json',
			data: {datos: valor, type: tipo},
			url: 'freelancer/edit_freelancer',
		}).
		done(function (data) {

			if (data.status == true) {
				getNotificacion('success', data.msg);
				if (data.lugar == 'profesion') {
					$("#secctionOficio").html(valor);
				}
			} else {
				getNotificacion('error', data.msg);
			}

		}).
		fail(function () {
			getNotificacion('error', "Error interno");
		});
}