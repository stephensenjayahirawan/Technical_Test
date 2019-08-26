
<!-- Mainly scripts -->
<script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<!-- Custom and plugin javascript -->

   <script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
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
			dom: '<"html5buttons"B>lTfgitp',
			buttons: [
				{extend: 'copy'},
				{extend: 'csv'},
				{extend: 'excel', title: 'Employee Data'},
				{extend: 'pdf', title: 'Employee Data'},
				{extend: 'print',
				customize: function (win){
						$(win.document.body).addClass('white-bg');
						$(win.document.body).css('font-size', '10px');

						$(win.document.body).find('table')
						.addClass('compact')
						.css('font-size', 'inherit');
					}
				}
			]

		});
		$('#date1 .input-group.date').datepicker({
			startView: 2,
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			autoclose: true,
			format: "yyyy-mm-dd"
		});
		
		

	});
</script>
	<script>
	// var flickerAPI = "https://localhost/Technical_Test/get/10";
	
	$(document).ready(function(){
		$('.EDIT_BUTTON').click(function(){
			var edit_url = "<?php echo base_url() ?>"+"edit/"+$(this).attr('id_employee');
			$('#EDIT_FORM').attr('action',edit_url);
			var flickerAPI = "<?php echo base_url(); ?>"+"get/" +$(this).attr('id_employee');
			// alert(flickerAPI);
			$.getJSON( flickerAPI, {
				tags: "mount rainier",
				tagmode: "any",
				format: "json"
			  }).done(function( data ) {
				$.each( data, function( i, item ) {
					
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
			});
		});
		   
	});
	</script>
</body>

</html>
