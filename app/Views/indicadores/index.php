<?=$header?>
<main class="container">
    <div class="row">
        <div class="m-3">
          <a href="<?=base_url('/create/');?>" class="btn btn-success btn-sm" type="button">Nuevo</a>
        </div>
        <div class="col-12">
        <div clas="table-responsive">
            <table class="table table-bordered table-light">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Código</th>
                    <th>Valor</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($uf as $u): ?>
                <tr>
                    <td><?=$u['id'];?></td>
                    <td><?=subStr($u['fecha'],0,10);?></td>
                    <td><?=$u['nombre'];?></td>
                    <td>$ <?=$u['valor'];?></td>
                    <td><?=$u['delete_status'];?></td>
                    <td>
                        <a href="<?=base_url('/delete/'.$u['id']);?>" class="btn btn-danger btn-sm" type="button">X</a>
                        <a href="<?=base_url('/edith/'.$u['id']);?>" class="btn btn-primary btn-sm" type="button">E</a>
                    </td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <hr class="hr">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <button type="button" id="bd" class="btn btn-warning btn-sm ms-3">Guardar en BD</button>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
		   <div class="form">
                <label class="d-inline">
                    <span class="text-muted">Desde: / Hasta: </span>
                    <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="date" name="desde" id="desde" class="form-control" step="1" value="">
                        <span class="input-group-addon"></span>
                        <input type="date" name="hasta" name="id" class="form-control" step="1" value="<?= date('Y-m-d');?>">
                        <select class="form-select" id="indiceSelect" aria-label="select">
                        <option value="uf">uf</option>
                        <option value="dolar">dolar</option>
                        <option value="euro">euro</option>
                        <option value="ipc">ipc</option>
                        <option value="utm">utm</option>
                        </select>
                        <button type="submit" id="obtener" class="btn btn-success btn-sm">Obtener</button>
                      
                </label>
		  </div>
     	</div>
    </div>
    <div class="row mt-3    "><div class="col-12"><canvas id="ufGrafica"></canvas></div></div>
    
</main>

<script type="text/javascript">  

   var fecha;
   var dataFecha = [];
   var dataFechaSelect = [];
   var dataValor = [];
   var dataValorSelect = [];
   var c=0;
   var desde;
   var hasta;


   $("#bd").hide();

   $("#bd").click(function(){

        var url = "/createajax";
            $.ajax({                        
            type: "POST",                 
            url: url,                     
            data: {'fechas': JSON.stringify(dataFechaSelect), 'valores' : JSON.stringify(dataValorSelect)},
            success: function(data)             
            {
                console.log(data);   
                location.reload();            
            }
        });
    });

     function leerApi(){
         indicador = $("#indiceSelect").val();
         apiUrl = 'https://mindicador.cl/api/' + indicador;
        $.getJSON(apiUrl)
            .done(function( json ) {
                for(let data of json.serie){
                    fecha = moment(data.fecha).utc().format('YYYY/MM/DD');
                    dataFecha[c]= fecha;
                    dataValor[c] = data.valor;
                    c++;
                }
                obtener();
            })
            .fail(function( jqxhr, textStatus, error ) {
                var err = textStatus + ", " + error;
                console.log( "Request Falló: " + err );
            });
    }   

    $('#obtener').click(function()
    {    
        limpiar();
        leerApi();  
    });   

    function obtener(){
        desde = $('#desde').val();
        hasta = $('#hasta').val();
        if(desde == '' || hasta == '') { return alert("Ingrese Fechas"); }
        if(hasta < desde) { return alert("La Fecha Final es Menor a la Inicial.");}
        desde = moment(desde).utc().format('YYYY/MM/DD');
        hasta = moment(hasta).utc().format('YYYY/MM/DD');
        obtenerUf(desde,hasta);
    }

    function obtenerUf(desde, hasta) {
        
        c = 0;
        for(var i=0; i< dataFecha.length; i++){
            if(dataFecha[i] <= hasta && dataFecha[i] >=  desde){
            dataFechaSelect[c] = dataFecha[i]; 
            dataValorSelect[c] = dataValor[i];
            c++;
            }
        }

        verGrafica();
    }

    function limpiar(){
        dataFecha=[];
        dataValor=[];
        dataFechaSelect = [];
        dataValorSelect = [];
    }


    function verGrafica() {
        if(indicador=='uf'){$("#bd").show();}else{$("#bd").hide();}
        var ufGrafica = $("#ufGrafica");
        Chart.defaults.global.defaultFontFamily = "Verdana";
        Chart.defaults.global.defaultFontSize = 18;
        console.log('-------------------');
        console.log(dataFechaSelect);
        var ufData = {
        labels: dataFechaSelect,
        datasets: [{
            label: indicador,
            data:  dataValorSelect
        }]
        };

        var chartOptions = {
        legend: {
            display: true,
            position: 'top',
            labels: {
            boxWidth: 80,
            fontColor: 'black'
            }
        }
        };

        var lineChart = new Chart(ufGrafica, {
        type: 'line',
        data: ufData,
        options: chartOptions
        });
    }

    $(document).ready(function() {   
            
                
    });

</script>


<?=$footer?>
