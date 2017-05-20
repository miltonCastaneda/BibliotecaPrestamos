
jQuery.extend(jQuery.validator.messages, {
    required:"Campo Obligatorio!"
});

(function (document,window,$,undefined){

	(function (){

		return Libros = {
		    $ButtonEnviar: $('#Guardar'),
		    $ButtonCancelar: $('#Cancelar'),
		    FormLibros   : $('#formLibro'),
			Referencia   : $('#Referencia'),
			Titulo       : $('#Titulo'),
			Autor        : $('#Autor'),
			Categoria    : $('#Categoria'),
			Modal        : $('#ModalAlertas'),
			$ButtonCrear : $('#Crear'),
			$ButtonConsultar : $('#Consultar'),
			$ButtonEditar : $('#Editar'),
			$ButtonEliminar : $('#Eliminar'),
			TextoAlerta  : $('#TextoAlerta'),
			Accion       : '',
			validator    : 0,

			Init: function (){

				this.ListenActionsButton()
				this.HiddenInputs()
				this.ListenButtonCreate()
				this.ListenButtonCancel()
				this.ListenButtonConsultar()
				this.ListenButtonUpdate()
				this.ListenButtonDelete()
			},

			ListenActionsButton: function ( e ){
				var self = this
				self.$ButtonEnviar.on('click', function ( e ) {
					e.preventDefault()
					self.validateInputs()
					
						if(self.Accion !== "Consult"){
							if(self.validator == 0){
								$.post('../Controllers/BookController.php',{Accion:self.Accion,Referencia: self.Referencia.val(),Titulo:self.Titulo.val(),Autor:self.Autor.val(),Categoria:self.Categoria.val()}, function ( data ) {
									if(data != "Fallo"){
										self.TextoAlerta.empty()
												        .text("Registro Guardado Correctamente.")
										self.Modal.modal('show')
										self.EmptyInputs()
									}else{
										alert("Fallo en el registro.")
									}
								})
							}else{
								alert("Complete los campos Obligatorios")
							}
						}else{
							$.post('../Controllers/BookController.php',{Accion:self.Accion,Referencia: self.Referencia.val()}, function ( result ) {
								if(result == "NoExiste"){
									alert("No se encentra el libro")
								}else{
									self.TextoAlerta.empty()
													.text("Registro Consultado. Para actualizar pulse en Editar y luego GUARDE su registro")
									self.Modal.modal('show')
									var data = JSON.parse(result)
									self.CargarForm(data)
								}
							})
						}
				})				
			},

			validateInputs: function () {
				var self = this
				self.validator = 0;
				if(self.Referencia.val() == "" || self.Titulo.val() == "" || self.Autor.val() == "" || self.Categoria.val() == ""){
					self.validator = 1;
				}
			},

			HiddenInputs: function (){
				var self = this
				self.Referencia.attr('disabled', true)
				self.Titulo.attr('disabled', true)
				self.Autor.attr('disabled', true)
				self.Categoria.attr('disabled', true)

			},

			EnableInputs: function (){
				var self = this
				self.Referencia.removeAttr("disabled")
				self.Titulo.removeAttr("disabled")
				self.Autor.removeAttr("disabled")
				self.Categoria.removeAttr("disabled")
			},

			EmptyInputs: function () {
				var self = this
				self.Referencia.val("")
				self.Titulo.val("")
				self.Autor.val("")
				self.Categoria.val("")
			},

			ListenButtonCreate: function(){
				var self = this
				self.$ButtonCrear.on('click', function ( e ) {
					self.EnableInputs()
					self.Accion = "SaveBook"
				})
			},

			ListenButtonCancel: function () {
				var self = this
				self.$ButtonCancelar.on('click', function ( e ) {
					e.preventDefault()
					alert()
					self.HiddenInputs()
				})
			},

			ListenButtonConsultar: function (){
				var self = this
				self.$ButtonConsultar.on('click', function ( e ) {
					e.preventDefault()
					self.EnableInputs()
					self.Titulo.attr("disabled", true)
					self.Autor.attr("disabled", true)
					self.Categoria.attr("disabled", true)
					self.$ButtonEnviar.empty()
									  .text('Consultar')
					self.$ButtonEnviar.attr("data-accion", "Consult")
					self.Accion = "Consult"				  
				})
			},

			CargarForm: function (data){
				var self = this
				self.Titulo.val(data[0].Titulo)
				self.Autor.val(data[0].Autor)
				self.Categoria.val(data[0].Categoria)
			},

			ListenButtonUpdate: function () {
				var self = this
				self.$ButtonEditar.on('click', function () {
					self.EnableInputs()
					self.$ButtonEnviar.empty()
								      .text('Actualizar')
					self.$ButtonEnviar.attr("data-accion", "UpdateBook")
					self.Accion = "UpdateBook"
				})				
			},

			ListenButtonDelete: function () {
				var self = this,
					resp
				self.$ButtonEliminar.on('click', function () {
					resp = confirm("Vas a Eliminar. ¿ Quieres confirmar ?")
					if(resp != false){
						$.post('../Controllers/BookController.php',{Accion:'Delete',Referencia:self.Referencia.val()}, function ( resp ) {
							if(resp == "OK"){
								self.TextoAlerta.empty()
												.text("Registro Eliminado Exitosamente.")
								self.Modal.modal('show')
								self.EmptyInputs()								
							}else{
								alert("Falla en el borrado del registro")
							}
						})
					}
				})
			},
		}
	})()

	Libros.Init()

})(document,window,jQuery)