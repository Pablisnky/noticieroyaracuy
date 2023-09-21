        $(function(){
            $("#datepicker").datepicker({
                minDate: 0, //impide seleccionar dias pasados

                dateFormat: 'dd-mm-yy', //da formato a la fecha


                //beforeShowDay:$.datepicker.noWeekends//impide seleccionar fines de semana

                // beforeShowDay: function(date){//impide seleccionar los Domingos, 0=domingo, 1=lunes, 2=marets......
                //     var day = date.getDay();
                //     return [(day != 0), ''];
                // }
            });
        });

        $(function(){    
            //Array para dar formato en español
            $.datepicker.regional['es'] = {
            closeText: 'Cerrar', 
            prevText: 'Previo', 
            nextText: 'Próximo',    
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            monthStatus: 'Ver otro mes', 
            yearStatus: 'Ver otro año',
            dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
            dateFormat: 'yy/mm/dd', firstDay: 0, 
            initStatus: 'Selecciona la fecha', isRTL: false};
            $.datepicker.setDefaults($.datepicker.regional['es']);
        });