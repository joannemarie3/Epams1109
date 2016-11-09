<form id="loginForm" name="loginForm" >
	<div class="container-fluid" style="margin-top:40px">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
				<div class="box box-success">
					<div class="box-header with-border"></div><!-- /.box-header -->
					<div class="box-body no-padding">
						<fieldset>
							<div class="row">
								<div class="center-block">
									<img class="profile-img"
										src="<?=base_url()?>media/comp_logo/epLogo.png" alt="">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-10  col-md-offset-1 ">
									<div class="form-group">
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user"></i>
											</span>
											<input type="text" placeholder="Username" name="uname" id="uname" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-lock"></i>
											</span>
											<input type="password" placeholder="Password" name="pname" id="pname" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<button onclick="return lgn_checker();" class="btn btn-lg btn-success btn-block" >Sign in</button>
									</div>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
	function lgn_checker() {
		var has_err=0;
		var has_err_arr=[];
		if($("#uname").val()==''){
				has_err=1;
				has_err_arr.push("Please Enter a Username");
		}
		if($("#pname").val()==''){
				has_err=1;
				has_err_arr.push("Please Enter a Password");
		}
		if(has_err==0){
			$.ajax({type:'POST',
			url: '<?=base_url()?>index.php/login/login_validation',
			data:$('#loginForm').serialize(),
				success: function(response) {
					//redirection
					if(response==1){
						window.location.href = "<?=base_url()?>panel/";
					}
					else{
						$.notify({
							icon:'fa fa-exclamation-triangle',
							message: 'Invalid Username or Password.'
						},{
							type: 'danger'
						});
					}
				}
			});
		}else{
			for(var i=0; i<has_err_arr.length; i++){
				$.notify({
						icon:'fa fa-exclamation-triangle',
						message: has_err_arr[i]
					},{
						type: 'danger'
				});
			}
		}
		return false;
	}
</script>
