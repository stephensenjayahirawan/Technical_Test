


		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="<?php echo base_url();?>assets/#"><i class="fa fa-bars"></i> </a>
					</div>
					

				</nav>
			</div>
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-10">
					<h2>Employee Data</h2>
				   
				</div>
				<div class="col-lg-2">

				</div>
			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success alert-dismissable">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert alert-danger alert-dismissable">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						<?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php endif ?>
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox ">
							<div class="ibox-title">
								<h5></h5>
								<div class="ibox-tools">
									<a class="collapse-link">
										<i class="fa fa-chevron-up"></i>
									</a>
									<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url();?>assets/#">
										<i class="fa fa-wrench"></i>
									</a>
									<ul class="dropdown-menu dropdown-user">
										<li><a href="<?php echo base_url();?>assets/#" class="dropdown-item">Config option 1</a>
										</li>
										<li><a href="<?php echo base_url();?>assets/#" class="dropdown-item">Config option 2</a>
										</li>
									</ul>
									<a class="close-link">
										<i class="fa fa-times"></i>
									</a>
								</div>
							</div>
							<div class="ibox-content">

								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover dataTables-example" >
										<thead>
											<tr>
												<th>No</th>
												<th>Name</th>
												<th>Address</th>
												<th>Email</th>
												<th>Action</th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$iterator = 1;
											if ($Employee && isset($Employee)) {
												# code...
											
											foreach ($Employee as $key) {?>
												<tr>
													<td><?php echo $iterator; ?></td>
													<td><?php echo $key['NAME']; ?></td>
													<td><?php echo $key['ADDRESS']; ?></td>
													<td><?php echo $key['NOTES']; ?></td>
													<td><?php echo $key['GENDER']; ?></td>
													<td><?php echo $key['DATE_OF_BIRTH']; ?></td>
													<td><?php echo $key['PLACE_OF_BIRTH']; ?></td>
													<td><?php echo $key['RELIGION']; ?></td>
													<td><?php echo $key['PHONE']; ?></td>
													<td><?php echo $key['EMAIL']; ?></td>
													<td>
														<a data-toggle="modal" class="EDIT_BUTTON" id_employee="<?php echo $key['ID']; ?>" href="#modal-edit" ><button class="btn btn-primary">EDIT</button></a>
														 <a href="<?php echo base_url(); ?>delete/<?php echo $key['ID'];?>"><button class="btn btn-danger" onclick="confirm('Are you sure want to delete?')">DELETE</button></a>
													</td>
												</tr>
											<?php 
											$iterator++;
											}
											} ?>
										</tbody>
									</table>
								</div>
								<div class="row container">
									<a  data-toggle="modal"  href="#modal-form" class="btn btn-outline btn-default" style="margin: 5px">
									   <i class="fa fa-plus"></i> Add
									</a>

									 <a class="btn btn-outline btn-success" style="margin: 5px">
										<i class="fa fa-upload"></i> Import from CSV
									</a> 
									<a class="btn btn-outline btn-info" style="margin: 5px" href="<?php echo base_url(); ?>exportToCSV">
										<i class="fa fa-download"></i> Export to CSV
									</a>
									 <a class="btn btn-outline btn-warning" style="margin: 5px" href="<?php echo base_url(); ?>downloadPDF">
										PDF
									</a>
									 <a class="btn btn-outline btn-danger" style="margin: 5px" href="<?php echo base_url(); ?>deleteAll">
										Clear All
									</a>
									<h1 id="coba"></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="modal-form" class="modal fade" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Add New Employee</h3>
								<?php echo form_open(base_url().'store'); ?>
									<div class="form-group">
										<label for="NAME">Name</label>
										<input required="1" type="text" name="NAME" id="NAME" placeholder="Enter your name" class="form-control">
									</div>
									<div class="form-group">
										<label for="GENDER">Gender</label>
										<select required="1" class="form-control" name="GENDER" id="GENDER">
											<option value="MALE">Male</option>
											<option value="FEMALE">Female</option>
										</select>
									</div>
									<div class="form-group">
										<label for="PLACE_OF_BIRTH">Place of Birth</label>
										<input required="1" type="text" name="PLACE_OF_BIRTH" id="PLACE_OF_BIRTH" placeholder="Enter you place of birth" class="form-control">
									</div>
									<div class="form-group" id="date1">
										<label for="DATE_OF_BIRTH">Date of birth</label>

										<div class="input-group date">
											<span class="input-group-addon">
												<i class="fa fa-calendar"></i></span><input  name="DATE_OF_BIRTH" id="DATE_OF_BIRTH" required="1" type="text" class="form-control" value="03/04/2014">
										</div><!-- 
										<input required="1" type="date" name="DATE_OF_BIRTH" id="DATE_OF_BIRTH" placeholder="Enter your name" class="form-control"> -->
									</div>
									<div class="form-group">
										<label for="RELIGION">Religion</label>
										<input required="1" type="text" name="RELIGION" id="RELIGION" placeholder="Enter your Religion" class="form-control">
									</div>
									<div class="form-group">
										<label for="ADDRESS">Address</label>
										<input required="1" type="text" name="ADDRESS" id="ADDRESS" placeholder="Enter your Address" class="form-control">
									</div>
									<div class="form-group">
										<label for="PHONE">Phone</label>
										<input required="1" type="text" name="PHONE" id="PHONE" placeholder="Enter your phone number" class="form-control">
									</div>
									<div class="form-group">
										<label for="EMAIL">Email</label>
										<input required="1" required="1" type="email" name="EMAIL" id="EMAIL" placeholder="Enter your email" class="form-control">
									</div>
									<div class="form-group">
										<label for="NOTES">Notes</label>
										<textarea required="1" name="NOTES" id="NOTES" placeholder="Enter your notes" class="form-control" rows="4" ></textarea> 
									</div>

									<div class="form-group">
										<input type="submit" class="form-control btn btn-primary">
									</div>
								<?php echo form_close(); ?>
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="modal-edit" class="modal fade" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<div class="row">
							<div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Add New Employee</h3>

								<?php 
								$attributes = array('id' => 'EDIT_FORM');
								echo form_open(base_url().'edit/',$attributes); ?>
									<div class="form-group">
										<label for="EDIT_NAME">Name</label>
										<input required="1" type="text" name="EDIT_NAME" id="EDIT_NAME" placeholder="Enter your name" class="form-control">
									</div>
									<div class="form-group">
										<label for="EDIT_GENDER">Gender</label>
										<select required="1" class="form-control" name="EDIT_GENDER" id="EDIT_GENDER">
											<option value="MALE">Male</option>
											<option value="FEMALE">Female</option>
										</select>
									</div>
									<div class="form-group">
										<label for="EDIT_PLACE_OF_BIRTH">Place of Birth</label>
										<input required="1" type="text" name="EDIT_PLACE_OF_BIRTH" id="EDIT_PLACE_OF_BIRTH" placeholder="Enter you place of birth" class="form-control">
									</div>
									<div class="form-group" id="date1">
										<label for="EDIT_DATE_OF_BIRTH">Date of birth</label>

										<div class="input-group date">
											<span class="input-group-addon">
												<i class="fa fa-calendar"></i></span><input  name="EDIT_DATE_OF_BIRTH" id="EDIT_DATE_OF_BIRTH" required="1" type="text" class="form-control" value="03/04/2014">
										</div><!-- 
										<input required="1" type="date" name="DATE_OF_BIRTH" id="DATE_OF_BIRTH" placeholder="Enter your name" class="form-control"> -->
									</div>
									<div class="form-group">
										<label for="EDIT_RELIGION">Religion</label>
										<input required="1" type="text" name="EDIT_RELIGION" id="EDIT_RELIGION" placeholder="Enter your Religion" class="form-control">
									</div>
									<div class="form-group">
										<label for="EDIT_ADDRESS">Address</label>
										<input required="1" type="text" name="EDIT_ADDRESS" id="EDIT_ADDRESS" placeholder="Enter your Address" class="form-control">
									</div>
									<div class="form-group">
										<label for="EDIT_PHONE">Phone</label>
										<input required="1" type="text" name="EDIT_PHONE" id="EDIT_PHONE" placeholder="Enter your phone number" class="form-control">
									</div>
									<div class="form-group">
										<label for="EDIT_EMAIL">Email</label>
										<input required="1" required="1" type="email" name="EDIT_EMAIL" id="EDIT_EMAIL" placeholder="Enter your email" class="form-control">
									</div>
									<div class="form-group">
										<label for="EDIT_NOTES">Notes</label>
										<textarea required="1" name="EDIT_NOTES" id="EDIT_NOTES" placeholder="Enter your notes" class="form-control" rows="4" ></textarea> 
									</div>

									<div class="form-group">
										<input type="submit" class="form-control btn btn-primary">
									</div>
								<?php echo form_close(); ?>
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>

	
	</div>

