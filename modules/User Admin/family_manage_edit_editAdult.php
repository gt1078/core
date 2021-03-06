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

if (isActionAccessible($guid, $connection2, "/modules/User Admin/family_manage_edit_editAdult.php")==FALSE) {
	//Acess denied
	print "<div class='error'>" ;
		print "You do not have access to this action." ;
	print "</div>" ;
}
else {
	//Proceed!
	print "<div class='trail'>" ;
	print "<div class='trailHead'><a href='" . $_SESSION[$guid]["absoluteURL"] . "'>Home</a> > <a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/" . getModuleName($_GET["q"]) . "/" . getModuleEntry($_GET["q"], $connection2, $guid) . "'>" . getModuleName($_GET["q"]) . "</a> > <a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/User Admin/family_manage.php'>Manage Families</a> > <a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/User Admin/family_manage_edit.php&gibbonFamilyID=" . $_GET["gibbonFamilyID"] . "'>Edit Family</a> > </div><div class='trailEnd'>Edit Adult</div>" ;
	print "</div>" ;
	
	if (isset($_GET["updateReturn"])) { $updateReturn=$_GET["updateReturn"] ; } else { $updateReturn="" ; }
	$updateReturnMessage ="" ;
	$class="error" ;
	if (!($updateReturn=="")) {
		if ($updateReturn=="fail0") {
			$updateReturnMessage ="Update failed because you do not have access to this action." ;	
		}
		else if ($updateReturn=="fail1") {
			$updateReturnMessage ="Update failed because a required parameter was not set." ;	
		}
		else if ($updateReturn=="fail2") {
			$updateReturnMessage ="Update failed due to a database error." ;	
		}
		else if ($updateReturn=="fail3") {
			$updateReturnMessage ="Update failed because your inputs were invalid." ;	
		}
		else if ($updateReturn=="fail4") {
			$updateReturnMessage ="Update failed some values need to be unique but were not." ;	
		}
		else if ($updateReturn=="success0") {
			$updateReturnMessage ="Update was successful." ;	
			$class="success" ;
		}
		print "<div class='$class'>" ;
			print $updateReturnMessage;
		print "</div>" ;
	} 
	
	//Check if school year specified
	$gibbonFamilyID=$_GET["gibbonFamilyID"] ;
	$gibbonPersonID=$_GET["gibbonPersonID"] ;
	$search=$_GET["search"] ;
	if ($gibbonPersonID=="" OR $gibbonFamilyID=="") {
		print "<div class='error'>" ;
			print "You have not specified a person or family." ;
		print "</div>" ;
	}
	else {
		try {
			$data=array("gibbonFamilyID"=>$gibbonFamilyID, "gibbonPersonID"=>$gibbonPersonID); 
			$sql="SELECT * FROM gibbonPerson, gibbonFamily, gibbonFamilyAdult WHERE gibbonFamily.gibbonFamilyID=gibbonFamilyAdult.gibbonFamilyID AND gibbonFamilyAdult.gibbonPersonID=gibbonPerson.gibbonPersonID AND gibbonFamily.gibbonFamilyID=:gibbonFamilyID AND gibbonFamilyAdult.gibbonPersonID=:gibbonPersonID AND (gibbonPerson.status='Full' OR gibbonPerson.status='Expected')" ;
			$result=$connection2->prepare($sql);
			$result->execute($data);
		}
		catch(PDOException $e) { 
			print "<div class='error'>" . $e->getMessage() . "</div>" ; 
		}

		if ($result->rowCount()!=1) {
			print "<div class='error'>" ;
				print "The specified person cannot be found." ;
			print "</div>" ;
		}
		else {
			//Let's go!
			$row=$result->fetch() ;
			
			if ($search!="") {
				print "<div class='linkTop'>" ;
					print "<a href='" . $_SESSION[$guid]["absoluteURL"] . "/index.php?q=/modules/User Admin/family_manage_edit.php&gibbonFamilyID=$gibbonFamilyID&search=$search'>Back</a>" ;
				print "</div>" ;
			}
			?>
			<form method="post" action="<? print $_SESSION[$guid]["absoluteURL"] . "/modules/" . $_SESSION[$guid]["module"] . "/family_manage_edit_editAdultProcess.php?gibbonFamilyID=$gibbonFamilyID&gibbonPersonID=$gibbonPersonID&search=$search" ?>">
				<table class='smallIntBorder' cellspacing='0' style="width: 100%">	
					<tr>
						<td> 
							<b>Adult's Name *</b><br/>
							<span style="font-size: 90%"><i></i></span>
						</td>
						<td class="right">
							<input readonly name="child" id="child" maxlength=200 value="<? print formatName(htmlPrep($row["title"]), htmlPrep($row["preferredName"]), htmlPrep($row["surname"]), "Parent") ?>" type="text" style="width: 300px">
							<script type="text/javascript">
								var child=new LiveValidation('child');
								child.add(Validate.Exclusion, { within: ['Please select...'], failureMessage: "Select something!"});
							 </script>
						</td>
					</tr>
					<tr>
						<td> 
							<b>Comment</b><br/>
							<span style="font-size: 90%"><i>Data displayed in full Student Profile<br/>1000 character limit<br/></i></span>
						</td>
						<td class="right">
							<textarea name="comment" id="comment" rows=8 style="width: 300px"><? print $row["comment"] ?></textarea>
							<script type="text/javascript">
								var comment=new LiveValidation('comment');
								comment.add( Validate.Length, { maximum: 1000 } );
							 </script>
						</td>
					</tr>
					<tr>
						<td> 
							<b>Data Access?</b><br/>
							<span style="font-size: 90%"><i>Access data on family's children?</i></span>
						</td>
						<td class="right">
							<select name="childDataAccess" id="childDataAccess" style="width: 302px">
								<option <? if ($row["childDataAccess"]=="Y") { print "selected ";} ?>value="Y">Y</option>
								<option <? if ($row["childDataAccess"]=="N") { print "selected ";} ?>value="N">N</option>
							</select>
						</td>
					</tr>
					<tr>
						<td> 
							<b>Contact Priority</b><br/>
							<span style="font-size: 90%"><i>The order in which school should contact family members.</i></span>
						</td>
						<td class="right">
							<select name="contactPriority" id="contactPriority" style="width: 302px">
								<option <? if ($row["contactPriority"]=="1") { print "selected ";} ?>value="1">1</option>
								<option <? if ($row["contactPriority"]=="2") { print "selected ";} ?>value="2">2</option>
								<option <? if ($row["contactPriority"]=="3") { print "selected ";} ?>value="3">3</option>
							</select>
							<script type="text/javascript">
								/* Advanced Options Control */
								$(document).ready(function(){
									<? 
									if ($row["contactPriority"]=="1") {
										print "$(\"#contactCall\").attr(\"disabled\", \"disabled\");" ;
										print "$(\"#contactSMS\").attr(\"disabled\", \"disabled\");" ;
										print "$(\"#contactEmail\").attr(\"disabled\", \"disabled\");" ;
										print "$(\"#contactMail\").attr(\"disabled\", \"disabled\");" ;
									}
									?>	
									$("#contactPriority").change(function(){
										if ($('#contactPriority').val() == "1" ) {
											$("#contactCall").attr("disabled", "disabled");
											$("#contactCall").val("Y");
											$("#contactSMS").attr("disabled", "disabled");
											$("#contactSMS").val("Y");
											$("#contactEmail").attr("disabled", "disabled");
											$("#contactEmail").val("Y");
											$("#contactMail").attr("disabled", "disabled");
											$("#contactMail").val("Y");
										} 
										else {
											$("#contactCall").removeAttr("disabled");
											$("#contactSMS").removeAttr("disabled");
											$("#contactEmail").removeAttr("disabled");
											$("#contactMail").removeAttr("disabled");
										}
									 });
								});
							</script>
						</td>
					</tr>
					<tr>
						<td> 
							<b>Call?</b><br/>
							<span style="font-size: 90%"><i>Receive non-emergency phone calls from school?</i></span>
						</td>
						<td class="right">
							<select name="contactCall" id="contactCall" style="width: 302px">
								<option <? if ($row["contactCall"]=="Y") { print "selected ";} ?>value="Y">Y</option>
								<option <? if ($row["contactCall"]=="N") { print "selected ";} ?>value="N">N</option>
							</select>
						</td>
					</tr>
					<tr>
						<td> 
							<b>SMS?</b><br/>
							<span style="font-size: 90%"><i>Receive non-emergency SMS messages from school?</i></span>
						</td>
						<td class="right">
							<select name="contactSMS" id="contactSMS" style="width: 302px">
								<option <? if ($row["contactSMS"]=="Y") { print "selected ";} ?>value="Y">Y</option>
								<option <? if ($row["contactSMS"]=="N") { print "selected ";} ?>value="N">N</option>
							</select>
						</td>
					</tr>
					<tr>
						<td> 
							<b>Email?</b><br/>
							<span style="font-size: 90%"><i>Receive non-emergency emails from school?</i></span>
						</td>
						<td class="right">
							<select name="contactEmail" id="contactEmail" style="width: 302px">
								<option <? if ($row["contactEmail"]=="Y") { print "selected ";} ?>value="Y">Y</option>
								<option <? if ($row["contactEmail"]=="N") { print "selected ";} ?>value="N">N</option>
							</select>
						</td>
					</tr>
					<tr>
						<td> 
							<b>Mail?</b><br/>
							<span style="font-size: 90%"><i>Receive postage mail from school?</i></span>
						</td>
						<td class="right">
							<select name="contactMail" id="contactMail" style="width: 302px">
								<option <? if ($row["contactMail"]=="Y") { print "selected ";} ?>value="Y">Y</option>
								<option <? if ($row["contactMail"]=="N") { print "selected ";} ?>value="N">N</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<span style="font-size: 90%"><i>* denotes a required field</i></span>
						</td>
						<td class="right">
							<input type="hidden" name="address" value="<? print $_SESSION[$guid]["address"] ?>">
							<input type="Submit" value="Submit">
						</td>
					</tr>
				</table>
			</form>
			<?
		}
	}
}
?>