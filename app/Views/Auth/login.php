<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<!-- logo -->
<div class="app-brand justify-content-center">
	<span class="app-brand-logo demo">
		<img style="width: 200px; height:70px" src="/assets/logo-1.png" alt="">
	</span>
</div>
<!-- /logo -->

<h4 class="mb-2">Selamat Datang! 👋</h4>
<p class="mb-4">Silakan masuk ke akun Anda</p>

<?= view('App\Views\Auth\_message_block') ?>

<form id="formAuthentication" class="mb-3" action="<?= url_to('login') ?>" method="POST">
	<?= csrf_field() ?>
	<?php if ($config->validFields === ['email']) : ?>
		<div class="form-group mb-3">
			<label for="login" class="form-label"><?= lang('Auth.email') ?></label>
			<input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
			<div class="invalid-feedback">
				<?= session('errors.login') ?>
			</div>
		</div>
	<?php else : ?>
		<div class="form-group mb-3">
			<label for="login" class="form-label"><?= lang('Auth.emailOrUsername') ?></label>
			<input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
			<div class="invalid-feedback">
				<?= session('errors.login') ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="mb-3 form-password-toggle">
		<div class="d-flex justify-content-between">
			<label class="form-label" for="password">Password</label>
			<?php if ($config->activeResetter) : ?>
				<a href="<?= url_to('forgot') ?>">
					<small>Lupa Password?</small>
				</a>
			<?php endif; ?>
		</div>
		<div class="input-group input-group-merge">
			<input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
			<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
		</div>
	</div>
	<div class="mb-3">
		<?php if ($config->allowRemembering) : ?>
			<div class="form-check">
				<input class="form-check-input" type="checkbox" id="remember-me" name="remamber" <?php if (old('remember')) : ?> checked <?php endif ?>>
				<label class="form-check-label" for="remember-me">
					Ingatkan saya
				</label>
			</div>
		<?php endif; ?>
	</div>
	<div class="mb-3">
		<button class="btn btn-primary d-grid w-100" type="submit" <?= lang('Auth.loginAction') ?>>Login</button>
	</div>
</form>
<?php if ($config->allowRegistration) : ?>
	<p class="text-center">
		<span>Belum mendaftar?</span>
		<a href="<?= url_to('register') ?>">
			<span>Buat Akun!</span>
		</a>
	</p>
<?php endif; ?>
<?= $this->endSection() ?>