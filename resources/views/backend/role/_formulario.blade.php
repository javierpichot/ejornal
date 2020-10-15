<div class="form-group">
        <div class="col-md-12">
            <div class="form-group">
                <label>Nombre</label>
                <input name="name" class="form-control" type="text" placeholder="Nombre del Rol" value="{{ isset($role) ? $role->name : '' }}"/>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label>Slug</label>
                <input name="slug" class="form-control" type="text" placeholder="Slug del Rol" value="{{ isset($role) ? $role->slug : '' }}"/>
            </div>
        </div>
</div>
