<template>
	<div class="row justify-content-center">
		<div class="col-5">
			<div class="card shadow">
				<div class="card-header bg-dark">
					<div class="card-body h-100">
						<div class="row align-items-center h-100">
							<img :src="`../dist/img/register.png`" :alt="alt" class="w-50 mx-auto">
						</div>
					</div>
				</div>
				<div class="card-body">
					<h1 class="text-center">{{ title }}</h1>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-user-tie c-icon"></i>
							</span>
						</div>
						<input class="form-control" type="text" placeholder="Username" id="username">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-envelope c-icon"></i>
							</span>
						</div>
						<input class="form-control" type="email" placeholder="Email" id="email">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-key c-icon"></i>
							</span>
						</div>
						<input class="form-control" type="password" placeholder="Password" id="password">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-key c-icon"></i>
							</span>
						</div>
						<input class="form-control" type="password" placeholder="Repeat password" id="repeat_password">
					</div>
					<div class="row">
						<div class="col">
							<hr>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<a :href="btnLogin.url" class="btn btn-light btn-block" role="button">
								<i class="far fa-times-circle"></i> {{ btnLogin.title }}
							</a>
						</div>
						<div class="col">
							<a :href="btnAdd.url" class="btn btn-dark btn-block" role="button">
								<i class="far fa-check-circle"></i> {{ btnAdd.title }}
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import '../../img/register.png'
	export default {
	  	name : 'register',
	  	data() {
	    	return {
	    		title : 'Register',
				alt   : 'Register',
				btnLogin : {
					url   : 'login',
					title : 'Cancelar'
				},
				btnAdd : {
					url   : 'add',
					title : 'Register'
				}
	    	};
	  	},
	};
</script>