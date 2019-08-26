
<!-- Mainly scripts -->
<script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<!-- Custom and plugin javascript -->

<script src="<?php echo base_url();?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/inspinia.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/pace/pace.min.js"></script>

<!-- Page-Level Scripts -->
<script>
	$(document).ready(function(){
		$('#myTable').DataTable( {
			buttons: [
			'pdf'
			]
		} );
		$('.dataTables-example').DataTable({
			pageLength: 10,
			responsive: true,
		// 	dom: '<"html5buttons"B>lTfgitp',
		// 	buttons: [
		// 	{extend: 'copy'},
		// 	{extend: 'csv'},
		// 	{extend: 'excel', title: 'Employee Data'},
		// 	{extend: 'pdf', title: 'Employee Data'},
		// 	{extend: 'print',
		// 	customize: function (win){
		// 		$(win.document.body).addClass('white-bg');
		// 		$(win.document.body).css('font-size', '10px');

		// 		$(win.document.body).find('table')
		// 		.addClass('compact')
		// 		.css('font-size', 'inherit');
		// 	}
		// }
		// ]

	});
		
		$('#date1 .input-group.date').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			format: "dd/mm/yyyy"
		});

		$('#EDIT_DATE_OF_BIRTH .input-group.date').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
		});
		$('.custom-file-input').on('change', function(e) {
			var file = e.target.files[0];
			var filesize = e.target.files[0].size;
			var name = e.target.files[0].name;
			var extension = name.substr( (name.lastIndexOf('.') +1) );
			switch(extension) {
				case 'csv':
				let fileName = $(this).val().split('\\').pop();
				$(this).next('.custom-file-label').addClass("selected").html(fileName);
				confirm('Make sure the date format is dd/mm/yyyy');
				break;
				default:
				alert('Ekstensi file tidak sesuai! Ekstensi harus .csv');
				$( "#input_csv" ).val('');
				return false;
			}
			
		}); 
		
	});
</script>
<script>
	
	$(document).ready(function(){
		$('.EDIT_BUTTON').click(function(){
			var id_employee = $(this).attr('id_employee');
			var edit_url = "<?php echo base_url() ?>"+"edit/" + id_employee;
			$('#EDIT_FORM').attr('action',edit_url);
			var flickerAPI = "<?php echo base_url(); ?>"+"get/";
			$.post(flickerAPI,  // url
		   	{ ID :  id_employee }, // data to be submit
		 	function(data, status, xhr) {   // success callback function
		 		$.each( data, function( i, item ) {
		 			$('#EDIT_DATE_OF_BIRTH').datepicker("setDate", new Date(item.DATE_OF_BIRTH ));

		 			$('#EDIT_NAME').val(item.NAME);
		 			$('#EDIT_GENDER').val(item.GENDER.toUpperCase());
		 			$('#EDIT_DATE_OF_BIRTH').val(item.DATE_OF_BIRTH);
		 			$('#EDIT_PLACE_OF_BIRTH').val(item.PLACE_OF_BIRTH);
		 			$('#EDIT_EMAIL').val(item.EMAIL);
		 			$('#EDIT_ADDRESS').val(item.ADDRESS);
		 			$('#EDIT_RELIGION').val(item.RELIGION);
		 			$('#EDIT_PHONE').val(item.PHONE);
		 			$('#EDIT_NOTES').val(item.NOTES);
		 		});
		 	},'json');
			
		});
		function setInputFilter(textbox, inputFilter) {
			["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
				textbox.addEventListener(event, function() {
					if (inputFilter(this.value)) {
						this.oldValue = this.value;
						this.oldSelectionStart = this.selectionStart;
						this.oldSelectionEnd = this.selectionEnd;
					} else if (this.hasOwnProperty("oldValue")) {
						this.value = this.oldValue;
						this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
					}
				});
			});
		}

// Restrict input to digits and '.' by using a regular expression filter.
setInputFilter(document.getElementById("EDIT_PHONE"), function(value) {
	return /^\d*?\d*$/.test(value);
});
setInputFilter(document.getElementById("PHONE"), function(value) {
	return /^\d*?\d*$/.test(value);
});
});
</script>
</body>

</html>
