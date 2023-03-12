						<?php
						if (isset($_REQUEST['btnsubmit'])) {
							$qry = "select * from tbl_admin where username='" . $_REQUEST['txtuname'] . "' and password='" . $_REQUEST['txtpassword'] . "'";
							$rs = mysqli_query($cn, $qry);
							if (mysqli_num_rows($rs) > 0) {
								while ($row = mysqli_fetch_array($rs)) {
									$logid = $row['login_id'];
									$uname = $row['username'];
									$pass = $row['password'];
								} // while over	
								if ($uname == $_REQUEST['txtuname'] && $pass == $_REQUEST['txtpassword']) {
									$_SESSION['logid'] = $logid;
									$_SESSION['uname'] = $uname;
									$qry = "insert into tbl_log values(NULL,'" . $logid . "',NOW())";
									$rs = mysqli_query($cn, $qry);
									if ($rs) {
										echo "<script>window.location = 'dashboard.php';</script>";
									} //if ENDED

								} else {
						?>
									<div class="alert alert-danger">
										Error! Username & password Does Not Match...
									</div>
								<?php
								} //If $uname == $_REQUEST ENDED
							} // if mysql_num_rows ENDED
							else {
								?>
								<div class="alert alert-danger">
									Error! Username & password Invalid.
								</div>
						<?php
							}
						} // If isset ENDED
						?>

