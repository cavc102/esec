<form id="guardarDatos" class="form-horizontal">
<div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Agregar usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
			<div id="datos_ajax_register"></div>
		  <div class="form-group">
            <label for="nombre" class="control-label col-sm-2">Nombre:</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="45">
          </div></div>
		  <div class="form-group">
            <label for="email" class="control-label col-sm-2">email:</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" required >
          </div></div>
		  <div class="form-group">
            <label for="contrasena" class="control-label col-sm-2">contraseña:</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="contrasena" name="contrasena" required> 
          </div></div>
          <div class="form-group">
            <label for="id_rol" class="control-label col-sm-2">Rol:</label>
            <div class="col-sm-10">
            <select name="id_rol" class="form-control" id="id_rol" >
		                    <option value=''>Seleccionar Un Rol</option>
                        <?php foreach($roles as $b){
                        echo "<option value='".$b->id_rol."'>".$b->nombre."</option>";
                        }?>
                      </select>
            
          </div></div>
          <div class="form-group">
            <label for="telefon" class="control-label col-sm-2">Telefono:</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="telefono" name="telefono" required maxlength="15">
          </div></div>
          <div class="form-group">
            <label for="direccion" class="control-label col-sm-2">Direccion:</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="direccion" name="direccion" required maxlength="15">
          </div></div>
          <div class="form-group">
            <label for="identificacion" class="control-label col-sm-2">Identificacion:</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="identificacion" name="identificacion" required maxlength="15">
            </div></div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar datos</button>
      </div>
    </div>
  </div>
</div>
</form>