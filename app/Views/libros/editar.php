<?=$header;?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Ingresar datos del libro</h5>
        <p class="card-text">
        <form method="post" action="<?=site_url('/actualizar');?>" enctype="multipart/form-data">
        <input type="hidden" name="idLibro" value="<?=$libro['idLibro'];?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input id="nombre" class="form-control" type="text" name="nombre" value="<?=$libro['aNombreLibro'];?>">
            </div>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <td><img class="img-thumbnail" src="<?= base_url() ?>/public/uploads/<?= $libro['mImagen']; ?>" width="100" alt=""><br></td>
                <input id="imagen" class="form-control" type="file" name="imagen">
            </div>
            <button class="btn btn-success" type="submit">Guardar</button>
        </form>
        </p>
    </div>
</div>

<?=$footer;?>