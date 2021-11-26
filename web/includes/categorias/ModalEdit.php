<!--/----------------------------------------MODAL EDITAR ---------------------------------------------------->
<div class="modal fade" id="ModalCategoria<?php echo $dato3['idCategoria']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Editar Categoria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <form id="formCatEditar" method="post" action="includes/categorias/checkEditCateg.php?idCategoria=<?php echo $dato3['idCategoria']; ?>">
                    
                        <div class="modal-body ">
                            <input type="text" id="idCategoria" name="idCategoria" class="form-control" value="<?php echo $dato3['idCategoria']; ?>" style="display: none;" />
                            <div class="form-group" style="padding: 0px;">
                                <label class="col-form-label">CATEGORIA</label>
                                <input type="text" placeholder="Categoria" id="nombreCategoria" name="nombreCategoria" class="form-control" value="<?php echo $dato3['nombreCategoria']; ?>" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit"  class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>