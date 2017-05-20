

//Disparadores de los Datepicker ( Calendarios ).

jQuery('#FechaPrestamo').datepicker({ dateFormat: 'yy-mm-dd' });

jQuery('#FechaDevolucion').datepicker({ dateFormat: 'yy-mm-dd' });


//Implementacion de JavaScript Orientado a Objetos.

(function (document,window,$,undefined){

	(function (){

		return Prestamos = {
		    $ButtonEnviar: $('#Guardar'),
		    $ButtonCancelar: $('#Cancelar'),
		    FormPrestamos   : $('#formPrestamos'),
			IdUsuario   : $('#Identificacion'),
			CodigoLibro       : $('#IdLibro'),
			NombreUsuario  : $('#NombreUsuario'),
			FechaPrestamo        : $('#FechaPrestamo'),
			FechaDevolucion        : $('#FechaDevolucion'),
			Modal        : $('#ModalAlertas'),
			$ButtonCrear : $('#Crear'),
			$ButtonCerraPrestamo : $('#Devolucion'),
			TextoAlerta   :   $('#TextoAlerta'),
			Accion       : '',
			Validator    : 0,



			//Call The Constructor
			Init: function (){

				this.ListenActionsButton()
				this.HiddenInputs()
				this.ListenButtonCreate()
				this.ListenButtonCancel()
				this.ListenButtonCerrarPrestamo()
			},

			ListenActionsButton: function ( e ){
				var self = this
				self.$ButtonEnviar.on('click', function ( e ) {
					e.preventDefault()
					self.validateInputs()
					if(self.validator == 0){
						$.post('../Controllers/BooksLoansController.php',{Accion:'SaveLoan',Identificacion: self.IdUsuario.val(),CodigoLibro:self.CodigoLibro.val(),FechaPrestamo:self.FechaPrestamo.val(),FechaDevolucion:self.FechaDevolucion.val()}, function ( data ) {
							self.TextoAlerta.empty()
											.text('Se Ha Registrado El Prestamo Exitosamente!')
							self.EmptyInputs()
							self.Modal.modal('show')

						})																									
					}else{
						alert("Todos los campos son obligatorios")
					}					
				})
			},

			HiddenInputs: function (){
				var self = this
				self.NombreUsuario.attr('disabled', true)
				self.CodigoLibro.attr('disabled', true)
				self.FechaPrestamo.attr('disabled', true)
				self.FechaDevolucion.attr('disabled', true)
			},

			EnableInputs: function (){
				var self = this
				self.IdUsuario.removeAttr("disabled")
				self.NombreUsuario.removeAttr("disabled")
				self.CodigoLibro.removeAttr("disabled")
				self.FechaDevolucion.removeAttr("disabled")
				self.FechaPrestamo.removeAttr("disabled")
			},

			ListenButtonCreate: function(){
				var self = this
				self.$ButtonCrear.on('click', function ( e ) {
					if(self.IdUsuario.val() != ""){
						$.post('../Controllers/BooksLoansController.php', {Accion:'ValidateUser',Identificacion: self.IdUsuario.val()}, function ( data ){
							var Data = JSON.parse(data)
							if(Data[0].Total == '1'){	
								self.TextoAlerta.empty()
												.text("Se Ha Validado El Usuario !")
								self.Modal.modal('show')
								self.NombreUsuario.val(Data[0].Nombre)
								self.EnableInputs()
							}else{
								alert("El usuario NO esta creado o Actualmente esta en PRESTAMO")
							}
						})
					}else{
						alert("Ingrese una Identificacion de usuario.")
					}
					
				})
				self.Accion = 'SaveLoan'

			},

			ListenButtonCancel: function () {
				var self = this
				self.$ButtonCancelar.on('click', function ( e ) {
					e.preventDefault()
					self.HiddenInputs()
				})
			},


			CargarForm: function (data){
				var self = this
				self.NombreUsuario.val(data[0].Titulo)
				self.CodigoLibro.val(data[0].Autor)
				self.DiasPlazo.val(data[0].Categoria)
			},

			ListenButtonCerrarPrestamo: function (){
				var self = this

				self.$ButtonCerraPrestamo.on('click', function () {
					if(self.IdUsuario.val() !== ""){
						$.post('../Controllers/BooksLoansController.php', {Accion:'Devolucion', Identificacion: self.IdUsuario.val()}, function (resp) {
							self.TextoAlerta.empty()
											.text('Devolucion Hecha con Exito !')
								self.Modal.modal('show')
						})
					}else{
						alert("Digite la cedula del usuario")
					}
				})
			},

			validateInputs: function (){
				var self = this

				self.validator = 0

				if(self.IdUsuario.val() == "" || self.CodigoLibro.val() == "" || self.FechaDevolucion.val() == "" || self.FechaPrestamo.val() == ""){
					self.validator = 1
				}
			},

			validateDate: function(FechaFinal) {
				var self = this,

				DateInicio = new Date(),
				Inicio = DateInicio.toLocaleDateString().split('/'),
				Final = FechaFinal.split('/')

				var dateStart = new Date(Inicio[2],(Inicio[1]-1),Inicio[0]);
	            var dateEnd =   new Date(Final[2],(Final[1]-1),Final[0]);
	            if(dateStart < dateEnd)
	            {
	                return true;
	            }
	            return false;


			},

			EmptyInputs: function (){
				var self = this

				self.IdUsuario.val("")
				self.CodigoLibro.val("")
				self.NombreUsuario.val("")
				self.FechaDevolucion.val("")
				self.FechaPrestamo.val("")
			}
		}
	})()

	Prestamos.Init()

})(document,window,jQuery)