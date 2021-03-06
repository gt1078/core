<?
/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

@session_start() ;

if (isActionAccessible($guid, $connection2, "/modules/User Admin/user_manage_add.php")==FALSE) {
	//Acess denied
	print "<div class='error'>" ;
		print "You do not have access to this action." ;
	print "</div>" ;
}
else {
	//Proceed!
	print "<div class='trail'>" ;
	print "<div class='trailHead'><a href='" . $_SESSION[$guid]["absoluteURL"] . "'>Home</a> > <a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/" . getModuleName($_GET["q"]) . "/" . getModuleEntry($_GET["q"], $connection2, $guid) . "'>" . getModuleName($_GET["q"]) . "</a> > <a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/User Admin/user_manage.php'>Manage Users</a> > </div><div class='trailEnd'>Add User</div>" ;
	print "</div>" ;
	
	if (isset($_GET["addReturn"])) { $addReturn=$_GET["addReturn"] ; } else { $addReturn="" ; }
	$addReturnMessage ="" ;
	$class="error" ;
	if (!($addReturn=="")) {
		if ($addReturn=="fail0") {
			$addReturnMessage ="Add failed because you do not have access to this action." ;	
		}
		else if ($addReturn=="fail2") {
			$addReturnMessage ="Add failed due to a database error." ;	
		}
		else if ($addReturn=="fail3") {
			$addReturnMessage ="Add failed because your inputs were invalid." ;	
		}
		else if ($addReturn=="fail4") {
			$addReturnMessage ="Add failed because some values need to be unique but were not." ;	
		}
		else if ($addReturn=="fail5") {
			$addReturnMessage ="Add failed because the passwords did not match." ;	
		}
		else if ($addReturn=="fail6") {
			$addReturnMessage ="Add failed due to an attachment error." ;	
		}
		else if ($addReturn=="fail7") {
			$addReturnMessage ="Update failed because your password to not meet the minimum requirements for strength." ;	
		}
		else if ($addReturn=="success0") {
			$addReturnMessage ="Add was successful. You can add another record if you wish." ;	
			$class="success" ;
		}
		print "<div class='$class'>" ;
			print $addReturnMessage;
		print "</div>" ;
	} 
	
	if ($_GET["search"]!="") {
		print "<div class='linkTop'>" ;
			print "<a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/User Admin/user_manage.php&search=" . $_GET["search"] . "'>Back to Search Results</a>" ;
		print "</div>" ;
	}
	?>
	<form method="post" action="<? print $_SESSION[$guid]["absoluteURL"] . "/modules/" . $_SESSION[$guid]["module"] . "/user_manage_addProcess.php?search=" . $_GET["search"] ?>" enctype="multipart/form-data">
		<table class='smallIntBorder' cellspacing='0' style="width: 100%">	
			<tr class='break'>
				<td colspan=2> 
					<h3>Basic Information</h3>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Title</b><br/>
				</td>
				<td class="right">
					<select style="width: 302px" name="title">
						<option value=""></option>
						<option value="Ms. ">Ms.</option>
						<option value="Miss ">Miss</option>
						<option value="Mr. ">Mr.</option>
						<option value="Mrs. ">Mrs.</option>
						<option value="Dr. ">Dr.</option>
					</select>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Surname *</b><br/>
					<span style="font-size: 90%"><i>Family name as shown in ID documents.</i></span>
				</td>
				<td class="right">
					<input name="surname" id="surname" maxlength=30 value="" type="text" style="width: 300px">
					<script type="text/javascript">
						var surname=new LiveValidation('surname');
						surname.add(Validate.Presence);
					 </script>
				</td>
			</tr>
			<tr>
				<td> 
					<b>First Name *</b><br/>
					<span style="font-size: 90%"><i>First name as shown in ID documents.</i></span>
				</td>
				<td class="right">
					<input name="firstName" id="firstName" maxlength=30 value="" type="text" style="width: 300px">
					<script type="text/javascript">
						var firstName=new LiveValidation('firstName');
						firstName.add(Validate.Presence);
					 </script>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Preferred Name *</b><br/>
					<span style="font-size: 90%"><i>Most common name, alias, nickname, etc.</i></span>
				</td>
				<td class="right">
					<input name="preferredName" id="preferredName" maxlength=30 value="" type="text" style="width: 300px">
					<script type="text/javascript">
						var preferredName=new LiveValidation('preferredName');
						preferredName.add(Validate.Presence);
					 </script>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Official Name *</b><br/>
					<span style="font-size: 90%"><i>Full name as shown in ID documents.</i></span>
				</td>
				<td class="right">
					<input name="officialName" id="officialName" maxlength=150 value="" type="text" style="width: 300px">
					<script type="text/javascript">
						var officialName=new LiveValidation('officialName');
						officialName.add(Validate.Presence);
					 </script>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Name In Characters</b><br/>
					<span style="font-size: 90%"><i>Chinese or other character-based name.</i></span>
				</td>
				<td class="right">
					<input name="nameInCharacters" id="nameInCharacters" maxlength=20 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<b>Gender *</b><br/>
				</td>
				<td class="right">
					<select name="gender" id="gender" style="width: 302px">
						<option value="Please select...">Please select...</option>
						<option value="F">F</option>
						<option value="M">M</option>
					</select>
					<script type="text/javascript">
						var gender=new LiveValidation('gender');
						gender.add(Validate.Exclusion, { within: ['Please select...'], failureMessage: "Select something!"});
					 </script>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Date of Birth</b><br/>
					<span style="font-size: 90%"><i>dd/mm/yyyy</i></span>
				</td>
				<td class="right">
					<input name="dob" id="dob" maxlength=10 value="" type="text" style="width: 300px">
					<script type="text/javascript">
						var dob=new LiveValidation('dob');
						dob.add( Validate.Format, {pattern: /^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/i, failureMessage: "Use dd/mm/yyyy." } ); 
					 </script>
					 <script type="text/javascript">
						$(function() {
							$( "#dob" ).datepicker();
						});
					</script>
				</td>
			</tr>
			<tr class='break'>
				<td colspan=2> 
					<h3>System Access</h3>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Primary Role *</b><br/>
					<span style="font-size: 90%"><i>Controls what a user can do and see.</i></span>
				</td>
				<td class="right">
					<select name="gibbonRoleIDPrimary" id="gibbonRoleIDPrimary" style="width: 302px">
						<?
						print "<option value='Please select...'>Please select...</option>" ;
						try {
							$dataSelect=array(); 
							$sqlSelect="SELECT * FROM gibbonRole ORDER BY name" ;
							$resultSelect=$connection2->prepare($sqlSelect);
							$resultSelect->execute($dataSelect);
						}
						catch(PDOException $e) { }
						while ($rowSelect=$resultSelect->fetch()) {
							print "<option value='" . $rowSelect["gibbonRoleID"] . "'>" . htmlPrep($rowSelect["name"]) . "</option>" ;
						}
						?>				
					</select>
					<script type="text/javascript">
						var gibbonRoleIDPrimary=new LiveValidation('gibbonRoleIDPrimary');
						gibbonRoleIDPrimary.add(Validate.Exclusion, { within: ['Please select...'], failureMessage: "Select something!"});
					 </script>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Username *</b><br/>
					<span style="font-size: 90%"><i>Needs to be unique. System login name.</i></span>
				</td>
				<td class="right">
					<input name="username" id="username" maxlength=20 value="" type="text" style="width: 300px">
					<?
					$idList="" ;
					try {
						$dataSelect=array(); 
						$sqlSelect="SELECT username FROM gibbonPerson ORDER BY username" ;
						$resultSelect=$connection2->prepare($sqlSelect);
						$resultSelect->execute($dataSelect);
					}
					catch(PDOException $e) { }
					while ($rowSelect=$resultSelect->fetch()) {
						$idList.="'" . $rowSelect["username"]  . "'," ;
					}
					?>
					<script type="text/javascript">
						var username=new LiveValidation('username');
						username.add( Validate.Exclusion, { within: [<? print $idList ;?>], failureMessage: "Username already in use!", partialMatch: false, caseSensitive: false } );
						username.add(Validate.Presence);
					 </script>
				</td>
			</tr>
			<tr>
				<td colspan=2>
					<?
					$policy=getPasswordPolicy($connection2) ;
					if ($policy!=FALSE) {
						print "<div class='warning'>" ;
							print $policy ;
						print "</div>" ;
					}
					?>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Password *</b><br/>
					<span style="font-size: 90%"><i></i></span>
				</td>
				<td class="right">
					<input name="password" id="password" maxlength=20 value="" type="password" style="width: 300px">
					<script type="text/javascript">
						var password=new LiveValidation('password');
						password.add(Validate.Presence);
						<?
						$alpha=getSettingByScope( $connection2, "System", "passwordPolicyAlpha" ) ;
						if ($alpha=="Y") {
							print "password.add( Validate.Format, { pattern: /.*(?=.*[a-z])(?=.*[A-Z]).*/, failureMessage: \"Does not meet password policy.\" } );" ;
						}
						$numeric=getSettingByScope( $connection2, "System", "passwordPolicyNumeric" ) ;
						if ($numeric=="Y") {
							print "password.add( Validate.Format, { pattern: /.*[0-9]/, failureMessage: \"Does not meet password policy.\" } );" ;
						}
						$punctuation=getSettingByScope( $connection2, "System", "passwordPolicyNonAlphaNumeric" ) ;
						if ($punctuation=="Y") {
							print "password.add( Validate.Format, { pattern: /[^a-zA-Z0-9]/, failureMessage: \"Does not meet password policy.\" } );" ;
						}
						$minLength=getSettingByScope( $connection2, "System", "passwordPolicyMinLength" ) ;
						if (is_numeric($minLength)) {
							print "password.add( Validate.Length, { minimum: " . $minLength . "} );" ;
						}
						?>
					 </script>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Confirm Password *</b><br/>
					<span style="font-size: 90%"><i></i></span>
				</td>
				<td class="right">
					<input name="passwordConfirm" id="passwordConfirm" maxlength=20 value="" type="password" style="width: 300px">
					<script type="text/javascript">
						var passwordConfirm=new LiveValidation('passwordConfirm');
						passwordConfirm.add(Validate.Presence);
						passwordConfirm.add(Validate.Confirmation, { match: 'password' } );
					 </script>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Status *</b><br/>
					<span style="font-size: 90%"><i>This determines visibility within the system.</i></span>
				</td>
				<td class="right">
					<select style="width: 302px" name="status">
						<option value="Full">Full</option>
						<option value="Expected">Expected</option>
						<option value="Left">Left</option>
					</select>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Can Login? *</b><br/>
					<span style="font-size: 90%"><i></i></span>
				</td>
				<td class="right">
					<select style="width: 302px" name="canLogin">
						<option value="Y">Y</option>
						<option value="N">N</option>
					</select>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Force Reset Password? *</b><br/>
					<span style="font-size: 90%"><i>User will be prompted on next login.</i></span>
				</td>
				<td class="right">
					<select style="width: 302px" name="passwordForceReset">
						<option value="Y">Y</option>
						<option value="N">N</option>
					</select>
				</td>
			</tr>
			
			<tr class='break'>
				<td colspan=2> 
					<h3>Contact Information</h3>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Email</b><br/>
				</td>
				<td class="right">
					<input name="email" id="email" maxlength=50 value="" type="text" style="width: 300px">
					<script type="text/javascript">
						var email=new LiveValidation('email');
						email.add(Validate.Email);
					 </script>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Alternate Email</b><br/>
					<span style="font-size: 90%"><i></i></span>
				</td>
				<td class="right">
					<input name="emailAlternate" id="emailAlternate" maxlength=50 value="" type="text" style="width: 300px">
					<script type="text/javascript">
						var emailAlternate=new LiveValidation('emailAlternate');
						emailAlternate.add(Validate.Email);
					 </script>
				</td>
			</tr>
			<tr>
				<td colspan=2> 
					<div class='warning'>
						Address information for an individual only needs to be set under the following conditions:
						<ol>
							<li>If the user is not in a family.</li>
							<li>If the user's family does not have a home address set.</li>
							<li>If the user needs an address in addition to their family's home address.</li>
						</ol>
					</div>
				</td>
			</tr>
			<?
			//Controls to hide address fields unless they are present, or box is checked
			?>
			<tr>
				<td> 
					<b>Enter Personal Address?</b><br/>
				</td>
				<td class='right' colspan=2> 
					<script type="text/javascript">
						/* Advanced Options Control */
						$(document).ready(function(){
							$(".address").slideUp("fast");
							$("#showAddresses").click(function(){
								if ($('input[name=showAddresses]:checked').val() == "Yes" ) {
									$(".address").slideDown("fast", $(".address").css("display","table-row")); 
								} 
								else {
									$(".address").slideUp("fast"); 
									$("#address1").val(""); 
									$("#address1District").val(""); 
									$("#address1Country").val(""); 
									$("#address2").val(""); 
									$("#address2District").val(""); 
									$("#address2Country").val(""); 
										
								}
							 });
						});
					</script>
					<input id='showAddresses' name='showAddresses' type='checkbox' value='Yes'/>
				</td>
			</tr>
			<tr class='address'>
				<td> 
					<b>Address 1</b><br/>
					<span style="font-size: 90%"><i>Unit, Building, Street</i></span>
				</td>
				<td class="right">
					<input name="address1" id="address1" maxlength=255 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr class='address'>
				<td> 
					<b>Address 1 District</b><br/>
					<span style="font-size: 90%"><i>County, State, District</i></span>
				</td>
				<td class="right">
					<input name="address1District" id="address1District" maxlength=30 value="" type="text" style="width: 300px">
				</td>
				<script type="text/javascript">
					$(function() {
						var availableTags=[
							<?
							try {
								$dataAuto=array(); 
								$sqlAuto="SELECT DISTINCT name FROM gibbonDistrict ORDER BY name" ;
								$resultAuto=$connection2->prepare($sqlAuto);
								$resultAuto->execute($dataAuto);
							}
							catch(PDOException $e) { }
							while ($rowAuto=$resultAuto->fetch()) {
								print "\"" . $rowAuto["name"] . "\", " ;
							}
							?>
						];
						$( "#address1District" ).autocomplete({source: availableTags});
					});
				</script>
			</tr>
			<tr class='address'>
				<td> 
					<b>Address 1 Country</b><br/>
				</td>
				<td class="right">
					<select name="address1Country" id="address1Country" style="width: 302px">
						<?
						print "<option value=''></option>" ;
						try {
							$dataSelect=array(); 
							$sqlSelect="SELECT printable_name FROM gibbonCountry ORDER BY printable_name" ;
							$resultSelect=$connection2->prepare($sqlSelect);
							$resultSelect->execute($dataSelect);
						}
						catch(PDOException $e) { }
						while ($rowSelect=$resultSelect->fetch()) {
							print "<option value='" . $rowSelect["printable_name"] . "'>" . htmlPrep($rowSelect["printable_name"]) . "</option>" ;
						}
						?>				
					</select>
				</td>
			</tr>
			<tr class='address'>
				<td> 
					<b>Address 2</b><br/>
					<span style="font-size: 90%"><i>Unit, Building, Street</i></span>
				</td>
				<td class="right">
					<input name="address2" id="address2" maxlength=255 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr class='address'>
				<td> 
					<b>Address 2 District</b><br/>
					<span style="font-size: 90%"><i>County, State, District</i></span>
				</td>
				<td class="right">
					<input name="address2District" id="address2District" maxlength=30 value="" type="text" style="width: 300px">
				</td>
				<script type="text/javascript">
					$(function() {
						var availableTags=[
							<?
							try {
								$dataAuto=array(); 
								$sqlAuto="SELECT DISTINCT name FROM gibbonDistrict ORDER BY name" ;
								$resultAuto=$connection2->prepare($sqlAuto);
								$resultAuto->execute($dataAuto);
							}
							catch(PDOException $e) { }
							while ($rowAuto=$resultAuto->fetch()) {
								print "\"" . $rowAuto["name"] . "\", " ;
							}
							?>
						];
						$( "#address2District" ).autocomplete({source: availableTags});
					});
				</script>
			</tr>
			<tr class='address'>
				<td> 
					<b>Address 2 Country</b><br/>
				</td>
				<td class="right">
					<select name="address2Country" id="address2Country" style="width: 302px">
						<?
						print "<option value=''></option>" ;
						try {
							$dataSelect=array(); 
							$sqlSelect="SELECT printable_name FROM gibbonCountry ORDER BY printable_name" ;
							$resultSelect=$connection2->prepare($sqlSelect);
							$resultSelect->execute($dataSelect);
						}
						catch(PDOException $e) { }
						while ($rowSelect=$resultSelect->fetch()) {
							print "<option value='" . $rowSelect["printable_name"] . "'>" . htmlPrep($rowSelect["printable_name"]) . "</option>" ;
						}
						?>				
					</select>
				</td>
			</tr>
			<?
			for ($i=1; $i<5; $i++) {
				?>
				<tr>
					<td> 
						<b>Phone <? print $i ?></b><br/>
						<span style="font-size: 90%"><i>Type, country code, number</i></span>
					</td>
					<td class="right">
						<input name="phone<? print $i ?>" id="phone<? print $i ?>" maxlength=20 value="" type="text" style="width: 160px">
						<select name="phone<? print $i ?>CountryCode" id="phone<? print $i ?>CountryCode" style="width: 60px">
							<?
							print "<option value=''></option>" ;
							try {
								$dataSelect=array(); 
								$sqlSelect="SELECT * FROM gibbonCountry ORDER BY printable_name" ;
								$resultSelect=$connection2->prepare($sqlSelect);
								$resultSelect->execute($dataSelect);
							}
							catch(PDOException $e) { }
							while ($rowSelect=$resultSelect->fetch()) {
								print "<option value='" . $rowSelect["iddCountryCode"] . "'>" . htmlPrep($rowSelect["iddCountryCode"]) . " - " .  htmlPrep($rowSelect["printable_name"]) . "</option>" ;
							}
							?>				
						</select>
						<select style="width: 70px" name="phone<? print $i ?>Type">
							<option value=""></option>
							<option value="Mobile">Mobile</option>
							<option value="Home">Home</option>
							<option value="Work">Work</option>
							<option value="Fax">Fax</option>
							<option value="Pager">Pager</option>
							<option value="Other">Other</option>
						</select>
						
					</td>
				</tr>
				<?
			}
			?>
			<tr>
				<td> 
					<b>Website</b><br/>
					<span style="font-size: 90%"><i>Include http://</i></span>
				</td>
				<td class="right">
					<input name="website" id="website" maxlength=255 value="" type="text" style="width: 300px">
					<script type="text/javascript">
						var text=new LiveValidation('text');
						text.add( Validate.Format, { pattern: /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/, failureMessage: "Must start with http://" } );
					</script>	
				</td>
			</tr>
			
			
			<tr class='break'>
				<td colspan=2> 
					<h3>School Information</h3>
				</td>
			</tr>
			<?
				$dayTypeOptions=getSettingByScope($connection2, 'User Admin', 'dayTypeOptions') ;
				if ($dayTypeOptions!="") {
					?>
					<tr>
						<td> 
							<b>Day Type</b><br/>
							<span style="font-size: 90%"><i><? print getSettingByScope($connection2, 'User Admin', 'dayTypeText') ; ?></i></span>
						</td>
						<td class="right">
							<select name="dayType" id="dayType" style="width: 302px">
								<option value=''></option>
								<?
								$dayTypes=explode(",", $dayTypeOptions) ;
								foreach ($dayTypes as $dayType) {
									print "<option value='" . trim($dayType) . "'>" . trim($dayType) . "</option>" ;
								}
								?>				
							</select>
						</td>
					</tr>
					<?
				}	
				?>
			<tr>
				<td> 
					<b>Last School</b><br/>
				</td>
				<td class="right">
					<input name="lastSchool" id="lastSchool" maxlength=30 value="" type="text" style="width: 300px">
				</td>
				<script type="text/javascript">
					$(function() {
						var availableTags=[
							<?
							try {
								$dataAuto=array(); 
								$sqlAuto="SELECT DISTINCT lastSchool FROM gibbonPerson ORDER BY lastSchool" ;
								$resultAuto=$connection2->prepare($sqlAuto);
								$resultAuto->execute($dataAuto);
							}
							catch(PDOException $e) { }
							while ($rowAuto=$resultAuto->fetch()) {
								print "\"" . $rowAuto["lastSchool"] . "\", " ;
							}
							?>
						];
						$( "#lastSchool" ).autocomplete({source: availableTags});
					});
				</script>
			</tr>
			<tr>
				<td> 
					<b>Start Date</b><br/>
					<span style="font-size: 90%"><i>Student's first day at school.<br/>dd/mm/yyyy</i></span>
				</td>
				<td class="right">
					<input name="dateStart" id="dateStart" maxlength=10 value="" type="text" style="width: 300px">
					<script type="text/javascript">
						var dateStart=new LiveValidation('dateStart');
						dateStart.add( Validate.Format, {pattern: /^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/i, failureMessage: "Use dd/mm/yyyy." } ); 
					 </script>
					 <script type="text/javascript">
						$(function() {
							$( "#dateStart" ).datepicker();
						});
					</script>
				</td>
			</tr>
			<tr>
				<td> 
					<b>End Date</b><br/>
					<span style="font-size: 90%"><i>Student's last day at school.<br/>dd/mm/yyyy</i></span>
				</td>
				<td class="right">
					<input name="dateEnd" id="dateEnd" maxlength=10 value="" type="text" style="width: 300px">
					<script type="text/javascript">
						var dateEnd=new LiveValidation('dateEnd');
						dateEnd.add( Validate.Format, {pattern: /^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/i, failureMessage: "Use dd/mm/yyyy." } ); 
					 </script>
					 <script type="text/javascript">
						$(function() {
							$( "#dateEnd" ).datepicker();
						});
					</script>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Class Of</b><br/>
					<span style="font-size: 90%"><i>When is the student expected to graduate?</i></span>
				</td>
				<td class="right">
					<select name="gibbonSchoolYearIDClassOf" id="gibbonSchoolYearIDClassOf" style="width: 302px">
						<?
						print "<option value=''></option>" ;
						try {
							$dataSelect=array(); 
							$sqlSelect="SELECT * FROM gibbonSchoolYear ORDER BY sequenceNumber" ;
							$resultSelect=$connection2->prepare($sqlSelect);
							$resultSelect->execute($dataSelect);
						}
						catch(PDOException $e) { 
							print "<div class='error'>" . $e->getMessage() . "</div>" ; 
						}
						while ($rowSelect=$resultSelect->fetch()) {
							print "<option value='" . $rowSelect["gibbonSchoolYearID"] . "'>" . htmlPrep($rowSelect["name"]) . "</option>" ;
						}
						?>				
					</select>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Next School</b><br/>
				</td>
				<td class="right">
					<input name="nextSchool" id="nextSchool" maxlength=30 value="" type="text" style="width: 300px">
				</td>
				<script type="text/javascript">
					$(function() {
						var availableTags=[
							<?
							try {
								$dataAuto=array(); 
								$sqlAuto="SELECT DISTINCT nextSchool FROM gibbonPerson ORDER BY nextSchool" ;
								$resultAuto=$connection2->prepare($sqlAuto);
								$resultAuto->execute($dataAuto);
							}
							catch(PDOException $e) { }
							while ($rowAuto=$resultAuto->fetch()) {
								print "\"" . $rowAuto["nextSchool"] . "\", " ;
							}
							?>
						];
						$( "#nextSchool" ).autocomplete({source: availableTags});
					});
				</script>
			</tr>
			<tr>
				<td> 
					<b>Departure Reason</b><br/>
				</td>
				<td class="right">
					<input name="departureReason" id="departureReason" maxlength=30 value="" type="text" style="width: 300px">
				</td>
				<script type="text/javascript">
					$(function() {
						var availableTags=[
							<?
							try {
								$dataAuto=array(); 
								$sqlAuto="SELECT DISTINCT departureReason FROM gibbonPerson ORDER BY departureReason" ;
								$resultAuto=$connection2->prepare($sqlAuto);
								$resultAuto->execute($dataAuto);
							}
							catch(PDOException $e) { }
							while ($rowAuto=$resultAuto->fetch()) {
								print "\"" . $rowAuto["departureReason"] . "\", " ;
							}
							?>
						];
						$( "#departureReason" ).autocomplete({source: availableTags});
					});
				</script>
			</tr>
			
			<tr class='break'>
				<td colspan=2> 
					<h3>Background Information</h3>
				</td>
			</tr>
			<tr>
				<td> 
					<b>First Language</b><br/>
				</td>
				<td class="right">
					<input name="languageFirst" id="languageFirst" maxlength=30 value="" type="text" style="width: 300px">
				</td>
				<script type="text/javascript">
					$(function() {
						var availableTags=[
							<?
							try {
								$dataAuto=array(); 
								$sqlAuto="SELECT DISTINCT languageFirst FROM gibbonPerson ORDER BY languageFirst" ;
								$resultAuto=$connection2->prepare($sqlAuto);
								$resultAuto->execute($dataAuto);
							}
							catch(PDOException $e) { }
							while ($rowAuto=$resultAuto->fetch()) {
								print "\"" . $rowAuto["languageFirst"] . "\", " ;
							}
							?>
						];
						$( "#languageFirst" ).autocomplete({source: availableTags});
					});
				</script>
			</tr>
			<tr>
				<td> 
					<b>Second Language</b><br/>
				</td>
				<td class="right">
					<input name="languageSecond" id="languageSecond" maxlength=30 value="" type="text" style="width: 300px">
				</td>
				<script type="text/javascript">
					$(function() {
						var availableTags=[
							<?
							try {
								$dataAuto=array(); 
								$sqlAuto="SELECT DISTINCT languageSecond FROM gibbonPerson ORDER BY languageSecond" ;
								$resultAuto=$connection2->prepare($sqlAuto);
								$resultAuto->execute($dataAuto);
							}
							catch(PDOException $e) { }
							while ($rowAuto=$resultAuto->fetch()) {
								print "\"" . $rowAuto["languageSecond"] . "\", " ;
							}
							?>
						];
						$( "#languageSecond" ).autocomplete({source: availableTags});
					});
				</script>
			</tr>
			<tr>
				<td> 
					<b>Third Language</b><br/>
				</td>
				<td class="right">
					<input name="languageThird" id="languageThird" maxlength=30 value="" type="text" style="width: 300px">
				</td>
				<script type="text/javascript">
					$(function() {
						var availableTags=[
							<?
							try {
								$dataAuto=array(); 
								$sqlAuto="SELECT DISTINCT languageThird FROM gibbonPerson ORDER BY languageThird" ;
								$resultAuto=$connection2->prepare($sqlAuto);
								$resultAuto->execute($dataAuto);
							}
							catch(PDOException $e) { }
							while ($rowAuto=$resultAuto->fetch()) {
								print "\"" . $rowAuto["languageThird"] . "\", " ;
							}
							?>
						];
						$( "#languageThird" ).autocomplete({source: availableTags});
					});
				</script>
			</tr>
			<tr>
				<td> 
					<b>Country of Birth</b><br/>
				</td>
				<td class="right">
					<select name="countryOfBirth" id="countryOfBirth" style="width: 302px">
						<?
						print "<option value=''></option>" ;
						try {
							$dataSelect=array(); 
							$sqlSelect="SELECT printable_name FROM gibbonCountry ORDER BY printable_name" ;
							$resultSelect=$connection2->prepare($sqlSelect);
							$resultSelect->execute($dataSelect);
						}
						catch(PDOException $e) { }
						while ($rowSelect=$resultSelect->fetch()) {
							print "<option value='" . $rowSelect["printable_name"] . "'>" . htmlPrep($rowSelect["printable_name"]) . "</option>" ;
						}
						?>				
					</select>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Ethnicity</b><br/>
				</td>
				<td class="right">
					<select name="ethnicity" id="ethnicity" style="width: 302px">
						<option value=""></option>
						<?
						$ethnicities=explode(",", getSettingByScope($connection2, "User Admin", "ethnicity")) ;
						foreach ($ethnicities as $ethnicity) {
							print "<option value='" . trim($ethnicity) . "'>" . trim($ethnicity) . "</option>" ;
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Religion</b><br/>
				</td>
				<td class="right">
					<select name="religion" id="religion" style="width: 302px">
						<option value=""></option>
						<option value="Nonreligious/Agnostic/Atheist">Nonreligious/Agnostic/Atheist</option>
						<option value="Buddhism">Buddhism</option>
						<option value="Christianity">Christianity</option>
						<option value="Hinduism">Hinduism</option>
						<option value="Islam">Islam</option>
						<option value="Judaism">Judaism</option>
						<option value="Other">Other</option>	
					</select>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Citizenship 1</b><br/>
				</td>
				<td class="right">
					<select name="citizenship1" id="countryOfBirth" style="width: 302px">
						<?
						print "<option value=''></option>" ;
						$nationalityList=getSettingByScope($connection2, "User Admin", "nationality") ;
						if ($nationalityList=="") {
							try {
								$dataSelect=array(); 
								$sqlSelect="SELECT printable_name FROM gibbonCountry ORDER BY printable_name" ;
								$resultSelect=$connection2->prepare($sqlSelect);
								$resultSelect->execute($dataSelect);
							}
							catch(PDOException $e) { }
							while ($rowSelect=$resultSelect->fetch()) {
								print "<option value='" . $rowSelect["printable_name"] . "'>" . htmlPrep($rowSelect["printable_name"]) . "</option>" ;
							}
						}
						else {
							$nationalities=explode(",", $nationalityList) ;
							foreach ($nationalities as $nationality) {
								print "<option value='" . trim($nationality) . "'>" . trim($nationality) . "</option>" ;
							}
						}
						?>				
					</select>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Citizenship 1 Passport Number</b><br/>
				</td>
				<td class="right">
					<input name="citizenship1Passport" id="citizenship1Passport" maxlength=30 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<b>Citizenship 2</b><br/>
				</td>
				<td class="right">
					<select name="citizenship2" id="countryOfBirth" style="width: 302px">
						<?
						print "<option value=''></option>" ;
						$nationalityList=getSettingByScope($connection2, "User Admin", "nationality") ;
						if ($nationalityList=="") {
							try {
								$dataSelect=array(); 
								$sqlSelect="SELECT printable_name FROM gibbonCountry ORDER BY printable_name" ;
								$resultSelect=$connection2->prepare($sqlSelect);
								$resultSelect->execute($dataSelect);
							}
							catch(PDOException $e) { }
							while ($rowSelect=$resultSelect->fetch()) {
								print "<option value='" . $rowSelect["printable_name"] . "'>" . htmlPrep($rowSelect["printable_name"]) . "</option>" ;
							}
						}
						else {
							$nationalities=explode(",", $nationalityList) ;
							foreach ($nationalities as $nationality) {
								print "<option $selected value='" . trim($nationality) . "'>" . trim($nationality) . "</option>" ;
							}
						}
						?>					
					</select>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Citizenship 2 Passport Number</b><br/>
				</td>
				<td class="right">
					<input name="citizenship2Passport" id="citizenship2Passport" maxlength=30 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<?
					if ($_SESSION[$guid]["country"]=="") {
						print "<b>National ID Card Number</b><br/>" ;
					}
					else {
						print "<b>" . $_SESSION[$guid]["country"] . " ID Card Number</b><br/>" ;
					}
					?>
				</td>
				<td class="right">
					<input name="nationalIDCardNumber" id="nationalIDCardNumber" maxlength=30 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<?
					if ($_SESSION[$guid]["country"]=="") {
						print "<b>Residency/Visa Type</b><br/>" ;
					}
					else {
						print "<b>" . $_SESSION[$guid]["country"] . " Residency/Visa Type</b><br/>" ;
					}
					?>
				</td>
				<td class="right">
					<?
					$residencyStatusList=getSettingByScope($connection2, "User Admin", "residencyStatus") ;
					if ($residencyStatusList=="") {
						print "<input name='residencyStatus' id='residencyStatus' maxlength=30 value='" .$row["residencyStatus"] . "' type='text' style='width: 300px'>" ;
					}
					else {
						print "<select name='residencyStatus' id='residencyStatus' style='width: 302px'>" ;
							print "<option value=''></option>" ;
							$residencyStatuses=explode(",", $residencyStatusList) ;
							foreach ($residencyStatuses as $residencyStatus) {
								print "<option value='" . trim($residencyStatus) . "'>" . trim($residencyStatus) . "</option>" ;
							}
						print "</select>" ;
					}
					?>
				</td>
			</tr>
			<tr>
				<td> 
					<?
					if ($_SESSION[$guid]["country"]=="") {
						print "<b>Visa Expiry Date</b><br/>" ;
					}
					else {
						print "<b>" . $_SESSION[$guid]["country"] . " Visa Expiry Date</b><br/>" ;
					}
					print "<span style='font-size: 90%'><i>dd/mm/yyyy. If relevant.</i></span>" ;
					?>
				</td>
				<td class="right">
					<input name="visaExpiryDate" id="visaExpiryDate" maxlength=10 value="" type="text" style="width: 300px">
					<script type="text/javascript">
						var visaExpiryDate=new LiveValidation('visaExpiryDate');
						visaExpiryDate.add( Validate.Format, {pattern: /^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/i, failureMessage: "Use dd/mm/yyyy." } ); 
					 </script>
					 <script type="text/javascript">
						$(function() {
							$( "#visaExpiryDate" ).datepicker();
						});
					</script>
				</td>
			</tr>
			
			
			<tr class='break'>
				<td colspan=2> 
					<h3>Employment</h3>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Profession</b><br/>
				</td>
				<td class="right">
					<input name="profession" id="profession" maxlength=30 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<b>Employer</b><br/>
				</td>
				<td class="right">
					<input name="employer" id="employer" maxlength=30 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<b>Job Title</b><br/>
				</td>
				<td class="right">
					<input name="jobTitle" id="jobTitle" maxlength=30 value="" type="text" style="width: 300px">
				</td>
			</tr>
			
			
			<tr class='break'>
				<td colspan=2> 
					<h3>Emergency Contacts</h3>
				</td>
			</tr>
			<tr>
				<td colspan=2> 
					These details are used when immediate family members (e.g. parent, spouse) cannot be reached first. Please try to avoid listing immediate family members. 
				</td>
			</tr>
			<tr>
				<td> 
					<b>Contact 1 Name</b><br/>
				</td>
				<td class="right">
					<input name="emergency1Name" id="emergency1Name" maxlength=30 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<b>Contact 1 Relationship</b><br/>
				</td>
				<td class="right">
					<select name="emergency1Relationship" id="emergency1Relationship" style="width: 302px">
						<option></option>
						<option value="Parent">Parent</option>
						<option value="Spouse">Spouse</option>
						<option value="Offspring">Offspring</option>
						<option value="Friend">Friend</option>
						<option value="Doctor">Doctor</option>
						<option value="Other">Other</option>
					</select>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Contact 1 Number 1</b><br/>
				</td>
				<td class="right">
					<input name="emergency1Number1" id="emergency1Number1" maxlength=30 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<b>Contact 1 Number 2</b><br/>
				</td>
				<td class="right">
					<input name="emergency1Number2" id="emergency1Number2" maxlength=30 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<b>Contact 2 Name</b><br/>
				</td>
				<td class="right">
					<input name="emergency2Name" id="emergency2Name" maxlength=30 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<b>Contact 2 Relationship</b><br/>
				</td>
				<td class="right">
					<select name="emergency2Relationship" id="emergency2Relationship" style="width: 302px">
						<option></option>
						<option value="Parent">Parent</option>
						<option value="Spouse">Spouse</option>
						<option value="Offspring">Offspring</option>
						<option value="Friend">Friend</option>
						<option value="Doctor">Doctor</option>
						<option value="Other">Other</option>
					</select>	
				</td>
			</tr>
			<tr>
				<td> 
					<b>Contact 2 Number 1</b><br/>
				</td>
				<td class="right">
					<input name="emergency2Number1" id="emergency2Number1" maxlength=30 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<b>Contact 2 Number 2</b><br/>
				</td>
				<td class="right">
					<input name="emergency2Number2" id="emergency2Number2" maxlength=30 value="" type="text" style="width: 300px">
				</td>
			</tr>
			
			<tr class='break'>
				<td colspan=2> 
					<h3>Images</h3>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Medium Portrait</b><br/>
					<span style="font-size: 90%"><i>240px by 320px</i></span>
				</td>
				<td class="right">
					<input type="file" name="file1" id="file1"><br/><br/>
					<script type="text/javascript">
						var file1=new LiveValidation('file1');
						file1.add( Validate.Inclusion, { within: ['gif','jpg','jpeg','png'], failureMessage: "Illegal file type!", partialMatch: true, caseSensitive: false } );
					</script>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Small Portrait</b><br/>
					<span style="font-size: 90%"><i>75px by 100px</i></span>
				</td>
				<td class="right">
					<input type="file" name="file2" id="file2"><br/><br/>
					<?
					print getMaxUpload(TRUE) ;				
					?>
					<script type="text/javascript">
						var file2=new LiveValidation('file2');
						file2.add( Validate.Inclusion, { within: ['gif','jpg','jpeg','png'], failureMessage: "Illegal file type!", partialMatch: true, caseSensitive: false } );
					</script>
				</td>
			</tr>
			
			<tr class='break'>
				<td colspan=2> 
					<h3>Misc</h3>
				</td>
			</tr>
			<tr>
				<td> 
					<b>House</b><br/>
					<span style="font-size: 90%"><i></i></span>
				</td>
				<td class="right">
					<select name="gibbonHouseID" id="gibbonHouseID" style="width: 302px">
						<?
						print "<option value=''></option>" ;
						try {
							$dataSelect=array(); 
							$sqlSelect="SELECT gibbonHouseID, name FROM gibbonHouse ORDER BY name" ;
							$resultSelect=$connection2->prepare($sqlSelect);
							$resultSelect->execute($dataSelect);
						}
						catch(PDOException $e) { }
						while ($rowSelect=$resultSelect->fetch()) {
							print "<option value='" . $rowSelect["gibbonHouseID"] . "'>" . htmlPrep($rowSelect["name"]) . "</option>" ;
						}
						?>				
					</select>
				</td>
			</tr>
			<tr>
				<td> 
					<b>Student ID</b><br/>
					<span style="font-size: 90%"><i>If set, must be unqiue.</i></span>
				</td>
				<td class="right">
					<input name="studentID" id="studentID" maxlength=10 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<b>Transport</b><br/>
					<span style="font-size: 90%"><i></i></span>
				</td>
				<td class="right">
					<input name="transport" id="transport" maxlength=255 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<script type="text/javascript">
				$(function() {
					var availableTags=[
						<?
						try {
							$dataAuto=array(); 
							$sqlAuto="SELECT DISTINCT transport FROM gibbonPerson ORDER BY transport" ;
							$resultAuto=$connection2->prepare($sqlAuto);
							$resultAuto->execute($dataAuto);
						}
						catch(PDOException $e) { }
						while ($rowAuto=$resultAuto->fetch()) {
							print "\"" . $rowAuto["transport"] . "\", " ;
						}
						?>
					];
					$( "#transport" ).autocomplete({source: availableTags});
				});
			</script>
			<tr>
				<td> 
					<b>Locker Number</b><br/>
					<span style="font-size: 90%"></span>
				</td>
				<td class="right">
					<input name="lockerNumber" id="lockerNumber" maxlength=20 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<tr>
				<td> 
					<b>Vehicle Registration</b><br/>
					<span style="font-size: 90%"></span>
				</td>
				<td class="right">
					<input name="vehicleRegistration" id="vehicleRegistration" maxlength=20 value="" type="text" style="width: 300px">
				</td>
			</tr>
			<?
			$privacySetting=getSettingByScope( $connection2, "User Admin", "privacy" ) ;
			$privacyBlurb=getSettingByScope( $connection2, "User Admin", "privacyBlurb" ) ;
			$privacyOptions=getSettingByScope( $connection2, "User Admin", "privacyOptions" ) ;
			if ($privacySetting=="Y" AND $privacyBlurb!="" AND $privacyOptions!="") {
				?>
				<tr>
					<td> 
						<b>Privacy *</b><br/>
						<span style="font-size: 90%"><i><? print htmlPrep($privacyBlurb) ?><br/>
						</i></span>
					</td>
					<td class="right">
						<?
						$options=explode(",",$privacyOptions) ;
						foreach ($options AS $option) {
							print $option . " <input type='checkbox' name='privacyOptions[]' value='" . htmlPrep(trim($option)) . "'/><br/>" ;
						}
						?>
						
					</td>
				</tr>
				<?
			}
			else {
				print "<input type=\"hidden\" name=\"privacy\" value=\"\">" ;
			}
			?>
			
			<tr>
				<td>
					<span style="font-size: 90%"><i>* denotes a required field</i></span>
				</td>
				<td class="right">
					<input type="hidden" name="address" value="<? print $_SESSION[$guid]["address"] ?>">
					<input type="submit" value="Submit">
				</td>
			</tr>
		</table>
	</form>
	<?
}
?>