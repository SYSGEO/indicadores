<?=$header?>


<div class="row mt-5" style="align-items: center ; justify-content: center">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Editar Valor</h4>
                <form class="row g-3" method="post" action="<?php site_url('/update');?>">
                <input type="hidden" name="id" value="<?=$uf['id']?>">
                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre  <b>*</b></label>
                        <input type="text" required name="nombre" min="1" max="120" class="form-control" value="<?=$uf['nombre']?>">
                    </div>
                    <div class="form-group">
                        <label for="valor" class="form-label">Válor  <b>*</b></label>
                        <input type="number" min="0" step="0.01" required name="valor" class="form-control" value="<?=$uf['valor']?>">
                    </div>
                    <div class="form-group mt-2">
                                    <label class="form-label">Fecha <b>*</b></label>
                                    <input type="date" required name="fecha" class="form-control" value="<?= subStr($uf['fecha'],0,10) ?>">
                    </div> 
                    <div class="form-group">
                        <label for="estado" class="form-label">Estado Inicial</label>
                        <select class="form-select" required name="estado" required>
       
                        <option <?php if($uf['delete_status']) { echo 'selected';} ?>  value="1">Habilitado</option>
                        <option <?php if(!$uf['delete_status']) { echo 'selected';} ?> value="0">Deshabilitado</option>

                        </select>
                    </div>
                    <div class="form-group float-right mt-5">
                            <a href="<?=base_url('/');?>"class="btn btn-danger" type="buntton"> Volver</a>
                            <button class="btn btn-success" type="submit"></i> Guardar</button>      	     
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?=$footer?>