
jQuery.extend(jQuery.validator.messages, {
	required: "Campo Obligatorio!"
});

(function (document, window, $, undefined) {

	(function () {
		console.log("function --")
		return Usuarios = {
			$ButtonEnviar: $('#Guardar'),
			$ButtonCancelar: $('#Cancelar'),
			FormUsuarios: $('#formUsuarios'),
			Nombre: $('#Nombre'),
			Apellido: $('#Apellido'),
			Email: $('#Email'),
			Telefono: $('#Telefono'),
			Identificacion: $('#Identificacion'),
			Modal: $('#ModalAlertas'),
			$ButtonCrear: $('#Crear'),
			$ButtonConsultar: $('#Consultar'),
			$ButtonEditar: $('#Editar'),
			$ButtonEliminar: $('#Eliminar'),
			TextoAlerta: $('#TextoAlerta'),
			validator: 0,
			Accion: '',

			Init: function () {
				console.log("function --")
				this.ListenActionsButton()
				this.HiddenInputs()
				this.ListenButtonCreate()
				this.ListenButtonCancel()
				this.ListenButtonConsultar()
				this.ListenButtonUpdate()
				this.ListenButtonDelete()
			},

			ListenActionsButton: function (e) {
				var self = this
				console.log("function --")
				self.$ButtonEnviar.on('click', function (e) {
					e.preventDefault()
					self.validateInputs()
					console.log("function --", self.Accion)
					if (self.Accion !== "Consult" && self.Accion !== "Delete" ) {
						console.log("function !Consult --", self.Accion)

						if (self.validator == 0) {
							$.post('../Controllers/UserController.php', { Accion: self.Accion, Identificacion: self.Identificacion.val(), Nombre: self.Nombre.val(), Apellido: self.Apellido.val(), Email: self.Email.val(), Telefono: self.Telefono.val() }, function (data) {
								self.TextoAlerta.empty()
									.text("Registro Guardo/Actualizado con Exito")
								self.Modal.modal('show')
								self.EmptyInputs()
								self.$ButtonEnviar.text('guardar')
							})
						} else {
							alert("Complete los campos obligatorios")
						}
					} else if (self.Accion === "Delete") {
						resp = confirm("Vas a Eliminar esto... Quieres confirmar ?")
						if (resp != false) {
							$.post('../Controllers/UserController.php', { Accion: self.Accion, Identificacion: self.Identificacion.val() }, function (resp) {
								if (resp == "OK") {
									self.TextoAlerta.empty()
										.text("Registro Eliminado con Exito.")
									self.Modal.modal('show')
									self.EmptyInputs()
									self.EnableInputs()
									self.Accion = "SaveUser"
									self.$ButtonEnviar.text('guardar')
								} else {
									alert("Fallo el borrado del registro")
								}
							})
						}
					} else {
						$.post('../Controllers/UserController.php', { Accion: self.Accion, Identificacion: self.Identificacion.val() }, function (result) {
							if (result == "NoExiste") {
								alert("El usuario no Existe")
							} else {
								self.TextoAlerta.empty()
									.text("Registro Consultado, para actualizar pulse en Editar y luego guarde su registro")
								self.Modal.modal('show')
								var data = JSON.parse(result)
								self.CargarForm(data)
								self.$ButtonEnviar.text('guardar')
							}
						})
					}
				})
			},

			HiddenInputs: function () {
				var self = this
				self.Identificacion.attr('disabled', true)
				self.Nombre.attr('disabled', true)
				self.Apellido.attr('disabled', true)
				self.Email.attr('disabled', true)
				self.Telefono.attr('disabled', true)

			},

			EmptyInputs: function () {
				var self = this
				self.Identificacion.val('')
				self.Nombre.val('')
				self.Apellido.val('')
				self.Email.val('')
				self.Telefono.val('')
			},

			validateInputs: function () {
				var self = this

				self.validator = 0
				if (self.Identificacion.val() == "" || self.Nombre.val() == "" || self.Apellido.val() == "" || self.Email.val() == "" || self.Telefono.val() == "") {
					self.validator = 1
				}


			},

			EnableInputs: function () {
				var self = this
				self.Identificacion.removeAttr("disabled")
				self.Nombre.removeAttr("disabled")
				self.Apellido.removeAttr("disabled")
				self.Email.removeAttr("disabled")
				self.Telefono.removeAttr("disabled")
			},

			ListenButtonCreate: function () {
				var self = this
				self.$ButtonCrear.on('click', function (e) {
					self.EnableInputs()
					self.Accion = "SaveUser"
				})
			},

			ListenButtonCancel: function () {
				var self = this
				self.$ButtonCancelar.on('click', function (e) {
					e.preventDefault()
					self.HiddenInputs()
				})
			},

			ListenButtonConsultar: function () {
				var self = this
				self.$ButtonConsultar.on('click', function (e) {
					e.preventDefault()
					self.EnableInputs()
					self.Nombre.attr("disabled", true)
					self.Apellido.attr("disabled", true)
					self.Email.attr("disabled", true)
					self.Telefono.attr("disabled", true)
					self.$ButtonEnviar.empty()
						.text('Consultar')
					self.$ButtonEnviar.attr("data-accion", "Consult")
					self.Accion = "Consult"
				})
			},

			CargarForm: function (data) {
				var self = this
				self.Nombre.val(data[0].Nombre)
				self.Apellido.val(data[0].Apellidos)
				self.Email.val(data[0].Email)
				self.Telefono.val(data[0].Telefono)

			},

			ListenButtonUpdate: function () {
				var self = this
				self.$ButtonEditar.on('click', function () {
					if(self.Accion == "Consult"){
						self.EnableInputs()
						self.$ButtonEnviar.empty()
							.text('Actualizar')
						self.$ButtonEnviar.attr("data-accion", "UpdateUser")
						self.Accion = "UpdateUser"
					}					
				})
			},

			ListenButtonDelete: function () {
				var self = this
				self.$ButtonEliminar.on('click', function (e) {
					e.preventDefault()
					self.EnableInputs()
					self.Nombre.attr("disabled", true)
					self.Apellido.attr("disabled", true)
					self.Email.attr("disabled", true)
					self.Telefono.attr("disabled", true)
					self.$ButtonEnviar.empty()
						.text('Delete')
					self.$ButtonEnviar.attr("data-accion", "Delete")
					self.Accion = "Delete"
				})
			},
		}
	})()

	Usuarios.Init()

})(document, window, jQuery)






