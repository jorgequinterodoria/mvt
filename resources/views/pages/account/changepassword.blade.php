
	<div class="container">
	<h4>Cambia la contraseña</h4>
	<hr />
	<div class="row">
		<div class="col-md-7">
			<form name="loginForm" action="<?php print_link("account/changepassword") ?>" method="post">
				@csrf
				<div class="form-group">
					<input placeholder="Contraseña actual" name="oldpassword" required="required" class="form-control" type="password" />
				</div>

				<div class="form-group">
					<div id="ctrl-password-holder" class="input-group ">
						<input value="" type="password" id="ctrl-newpassword" placeholder="Nueva contraseña" required="" name="newpassword" class="form-control  password password-strength" />
						<button  type="button" class="btn btn-outline-secondary btn-toggle-password">
								<i class="material-icons">visibility</i>
							</button>
					</div>
				</div>
				<div class="form-group">
					<div id="ctrl-confirmpassword-holder" class="input-group ">
						<input id="ctrl-password-confirm" data-match="#ctrl-newpassword" class="form-control password-confirm " type="password" name="confirmpassword" required placeholder="Confirmar nueva contraseña" />
						<button type="button" class="btn btn-outline-secondary btn-toggle-password">
							<i class="material-icons">visibility</i>
						</button>
					</div>
				</div>

				<div class="text-center">
					<button class="btn btn-primary" type="submit">Cambia la contraseña</button>
				</div>
			</form>
		</div>
	</div>
</div>
