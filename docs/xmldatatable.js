
var dataTable;

$(document).ready(function() {    
    /*
    dataTable = $('#example').DataTable({        
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel"></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
			{
				extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger'
			},
			{
				extend:    'print',
				text:      '<i class="fa fa-print"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-info'
			},
		]	        
    });     
    */
});


function load() {
    
var dataTable;
dataTable = $("#events").dataTable(
    {
        "sPaginationType": "full_numbers",
        "columnDefs": [
            { "visible": true, "targets": 2 }
          ],
        "bJQueryUI": true,
        "order": [[ 0, "desc" ]],
        "dom": 'Bfrtip',
        "buttons": [
            'copy',
             'csv',
              'excel',
               'pdf',
                'print'
        ]
    }
    
);

dtadire=[];
/*
dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]






$.ajax({
    //url:"https://XLWMHFNQXG1W5JTQ9MWY5A47WTJ9FYCT@impotec.cl/api/orders?display=full&sort=[id_DESC]&limit=2",
    url:"leedirecciones.php",
    dataType: "xml",
    type:"GET",
    crossDomain: true,
    headers:   'Access-Control-Allow-Origin:*' ,
    
    success: function(response){
        console.log(response);
        //addToTable(response);
        console.log(response);
        //addToTable(response);
        
        var $events = $(response).find("address");
        var $asociados = $(response).find("associations");
        $events.each(function(index, event){
            var $event = $(event),
            addData = [];

            $event.children().each(function(i, child){
                
                //addData.push($(child).text());total_paid_real;payment
                dtadire.push($event.children("alias").text());
                //addData.push($event.children("reference").text());
                
                

            });

            dataTable.fnAddData(addData);
        });
        
    }
});
*/
/*
var dataTable;
dataTable = $('#example').DataTable({        
    language: {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        },
    //para usar los botones   
    responsive: "true",
    dom: 'Bfrtilp',       
    buttons:[ 
        {
            extend:    'excelHtml5',
            text:      '<i class="fas fa-file-excel"></i> ',
            titleAttr: 'Exportar a Excel',
            className: 'btn btn-success'
        },
        {
            extend:    'pdfHtml5',
            text:      '<i class="fas fa-file-pdf"></i> ',
            titleAttr: 'Exportar a PDF',
            className: 'btn btn-danger'
        },
        {
            extend:    'print',
            text:      '<i class="fa fa-print"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info'
        },
    ]	        
});     
*/
$.ajax({
    //url:"https://XLWMHFNQXG1W5JTQ9MWY5A47WTJ9FYCT@impotec.cl/api/orders?display=full&sort=[id_DESC]&limit=2",
    url:"leerordenes.php",
    dataType: "xml",
    type:"GET",
    crossDomain: true,
    headers:   'Access-Control-Allow-Origin:*' ,
    
    success: function(response){
        console.log(response);
        //addToTable(response);
        
        var $events = $(response).find("order");
        var $asociados = $(response).find("associations");
        $events.each(function(index, event){
            var $event = $(event),
            addData = [];

            $event.children().each(function(i, child){
                
                //addData.push($(child).text());total_paid_real;payment
                addData.push($event.children("id").text());
                addData.push($event.children("reference").text());
                addData.push($event.children("total_paid").text());
                addData.push($event.children("payment").text());
                addData.push($(event).find("product_reference").text());
                addData.push($(event).find("product_name").text());
                if($(event).find("current_state").text()==10){
                    addData.push("En espera de pago por transferencia bancaria");
                }
                if($(event).find("current_state").text()==3){
                    addData.push("Preparacion en curso ");
                }
                if($(event).find("current_state").text()==15){
                    addData.push("Listo para retiro en tienda");
                }
                if($(event).find("current_state").text()==5){
                    addData.push("Entregado");
                }
                if($(event).find("current_state").text()==17){
                    addData.push("Listo para despacho");
                }
                //addData.push($event.children("associations").text());x = xmlDoc.getElementsByTagName("title");dtadire
               // addData.push(dtadire[0]);

            });

            dataTable.fnAddData(addData);
        });
        
    }
});



function addToTable(response){
    var $events = $(response).find("order");

    $events.each(function(index, event){
        var $event = $(event),
            addData = [];

        addData.push($event.attr("id").tex());
        addData.push($event.attr("reference").tex());
        addData.push($event.attr("monto").tex());
        

        dataTable.fnAddData(addData);
    });
}
}
window.onload = load;