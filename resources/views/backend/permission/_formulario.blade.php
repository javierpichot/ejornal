<div class="form-group">
        <div class="col-md-12">
            <div class="form-group">
                <label>Nombre</label>
                <input name="name" class="form-control" type="text" placeholder="Listado de proveedores" value="{{ isset($permission) ? $permission->name : '' }}"/>
            </div>
        </div>
<div class="col-md-12">
            <div class="form-group">
                <label>Descripción</label>
                <textarea name="description" class="form-control"  rows="4" placeholder="Descripción del permiso" value="{{ isset($permission) ? $permission->description : '' }}"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Slug</label>
                <input name="slug" class="form-control" type="text" placeholder="proveedor.view" value="{{ isset($permission) ? $permission->slug : '' }}"/>
            </div>
        </div>
</div>
