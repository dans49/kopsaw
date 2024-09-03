<div class="row">
	<!-- BACKUP -->
	<div class="col-sm-3">
		<div class="card card-primary">
			<div class="card-header">
				<h5 class="mt-2"><i class="fa fa-download"></i> Backup </h5>
			</div>
			<div class="card-body">
				<div class="box-content">
					<form method="POST" action="pages/backup restore/backup.php">
						<center>
							<button href="#" class="btn btn-success btn-icon-split btn-lg btn-sm" type="submit" name="backup">
								<span class="icon text-white-50">
									<i class="fas fa-download"></i>
								</span>
								<span class="text">Backup Database</span>
							</button>
						</center>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- RESTORE -->
	<div class="col-sm-6">
		<div class="card card-primary">
			<div class="card-header">
				<h5 class="mt-2"><i class="fa fa-upload"></i> Restore</h5>
			</div>
			<div class="card-body">
				<div class="box-content">
					<form method="POST" action="" enctype="multipart/form-data">
					<center>
							<label for="backup_file">Pilih file:</label>
							<input type="file" id="backup_file" name="backup_file" accept=".sql" required>
							<button href="#" class="btn btn-info btn-icon-split btn-lg btn-sm" type="submit" name="restore">
								<span class="icon text-white-50">
									<i class="fas fa-upload"></i>
								</span>
								<span class="text">Restore Database</span>
							</button>
					</center>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include "restore.php";