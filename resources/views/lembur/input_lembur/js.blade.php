{{-- custom javasvript untuk view Input Lembur --}}
<script type="text/javascript">
	$(document).ready(function() {
		moment.locale('id');
		$('[data-toggle="tooltip"]').tooltip();
		$('#alert_unggah').alert('close');

	    $("#upload").change(function(){
	      $('.custom-file-label').html(this.value.split("\\").pop());
	    });

	    data( moment().format('Y'), moment().format('MM') );

        

	});
	function date() {
		$('#tanggal').datetimepicker({
            locale: 'id',
            format: 'YYYY-MM-DD',
            inline: true,
            keepOpen : true,
            // showClear : true,
            // sideBySide: true,
            useCurrent: false,
            
        });
        $('#masuk').datetimepicker({
            locale: 'id',
            format: 'HH:mm:00',
            inline: true,
            keepOpen : true,
            // showClear : true,
            // sideBySide: true,
            useCurrent: false,
            
        });
        $('#keluar').datetimepicker({
            locale: 'id',
            format: 'HH:mm:00',
            inline: true,
            keepOpen : true,
            // showClear : true,
            // sideBySide: true,
            useCurrent: false,

        });

        $('#tanggal').data("DateTimePicker").maxDate( moment() );
        $("#tanggal").on("dp.change", function (e) {
            $('#txt_tanggal').html($("#tanggal").val());
            $('#masuk').data("DateTimePicker").minDate( moment(e.date).set('hour', 6) );
        });

        $("#masuk").on("dp.change", function (e) {
            $('#keluar').data("DateTimePicker").minDate( moment(e.date).set('hour', 7) );
            $('#keluar').data("DateTimePicker").maxDate( moment(e.date).set('hour', 0) );

            $('#txt_masuk').html($(this).val());
        });
        $("#keluar").on("dp.change", function (e) {
            $('#txt_keluar').html($(this).val());
        });
	}
	function data(tahun,bulan) {
		// alert(tahun+" - "+bulan);
		$('#upload-table').DataTable( {
			"bDestroy": true,
	        "responsive": true,
	        "processing": true,
	        "serverSide": true,
	        "sDom": 'tipr',
	        "order": [ [ 1, 'asc' ] ],
	        "ajax": {
	            "url" : "{{ route('upload_absensi.data') }}",
	            "type" : "POST",
	            "data" : {'tahun' : tahun, 'bulan' : bulan },
	            "beforeSend": function (request) {
	                request.setRequestHeader("X-CSRF-Token", "{{csrf_token()}}");
	            }
	        },
	        "columns": [
	        	{ "data" : "nik",
	              render : function(data, type, row, meta){
	                return (meta.row)+1;
	              }
	            },
	            { "data" : "nik"},
	          	{ "data" : "sys_user.name",
	            	render : function(data, type, row, meta){
	            	// console.log(data);
	                return data;
	              } 
	          	},
	            { "data" : "tanggal",
	            	render : function(data, type, row, meta){
	            		// console.log(data);
	                	return moment(data).format('l');
	            	}
	            },
	            { "data" : "masuk" },
	            { "data" : "keluar" },
	        ]
	    });
	}
</script>