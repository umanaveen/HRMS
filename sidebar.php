<html>
	<title></title>
	<head></head>
	<body>
	<!--<style>

ul{
	display:content !important;
}
.nav>li>a{
	display:block !important;
}
.collapse.in{
	display:none !important;
}
.nav>li{
	display: block !important;
}
.nav collapsing{
	display :block !important;
}
.nav collapse in{
	display :block !important;
}

</style>-->


	<div class="navbar-collapse" style="overflow-y: scroll;max-height: 580px;">
	<ul class="nav" id="side-menu">
	<li class="sidebar-search">
	<div class="input-group custom-search-form">
	<input type="text" class="form-control" placeholder="Search...">
	<span class="input-group-btn">
	<button class="btn btn-primary" type="button">
	<i class="fa fa-search"></i>
	</button>
	</span>
	</div>
	</li>	
	<?php
	$userrole=$_SESSION['userrole'];
	$sql = $con->query("SELECT zmsm.id,zmsm.menu_name,zmsm.call_method FROM z_masters_menu zmsm join z_role_detail zrd on zrd.menu_id=zmsm.id WHERE zrd.code='$userrole' and zrd.view_only='1' AND zrd.edit_only='1' AND zrd.all_only='1' group by menu_name");
	while($row = $sql->fetch(PDO::FETCH_ASSOC))
	{
		$menuid=$row['id'];
		?>
		<li>
		<a href="#"><i class="fa fa-sitemap fa-fw"></i> <?php echo $row['menu_name']; ?><span class="fa arrow"></span></a>
		<ul class="nav">
		<?php 
		$sql2 = $con->query("SELECT zmsm.name,zmsm.call_method FROM z_masters_sub_menu zmsm join z_role_detail zrd on zrd.submenu_id=zmsm.id WHERE zrd.code='$userrole' and zrd.menu_id='$menuid' and zrd.view_only='1' AND zrd.edit_only='1' AND zrd.all_only='1'");
		while($res = $sql2->fetch(PDO::FETCH_ASSOC))
		{ 
		?>  
		<li><a onclick="<?php echo $res['call_method']; ?>"><?php echo $res['name']; ?></a>	</li>
		<?php
		}
		?>
		</ul>
		</li>
		<?php
	}
	?>
	</ul>
	</div>
					


<script>

function application()
{
	$.ajax({
    type:"POST",
    url:"HRMS/Recruitment/new.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function consultant_master()
{
	$.ajax({
    type:"POST",
    url:"HRMS/consultant_master/consultant.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function feedback()
{
	$.ajax({
    type:"POST",
    url:"HRMS/interview_feedback/new.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function ctc_approval()
{
	$.ajax({
    type:"POST",
    url:"HRMS/ctcapproval/CTC_view.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function interview_reports()
{
	$.ajax({
    type:"POST",
    url:"HRMS/interviewreports/interviewreports.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function department_reports()
{
	$.ajax({
    type:"POST",
    url:"HRMS/departmentreports/departmentreports.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function ctc_reports()
{
	$.ajax({
    type:"POST",
    url:"HRMS/ctc_reports/ctc_reports.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

function staff_report()
{
	$.ajax({
    type:"POST",
    url:"HRMS/staff_report/staff_list_report.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function leave_master()
{
	$.ajax({
    type:"POST",
    url:"HRMS/leave_master/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function scale_master()
{
	$.ajax({
    type:"POST",
    url:"HRMS/scale_master/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
 function leave_management()
{
	$.ajax({
    type:"POST",
    url:"HRMS/leave_management/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
} 
 function emp_leave()
{
	$.ajax({
    type:"POST",
    url:"HRMS/employees_leave/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
} 
function employess()
{
	$.ajax({
    type:"POST",
    url:"HRMS/employees/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
} 
function employee_allowance()
{
	$.ajax({
    type:"POST",
    url:"HRMS/departmentreports/departmentreports.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function addition_allowance()
{
	$.ajax({
    type:"POST",
    url:"HRMS/addittion_allowance/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function employee_payroll()
{
	$.ajax({
    type:"POST",
    url:"HRMS/departmentreports/departmentreports.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function question_managements()
{ 

//alert("bala");
$.ajax({
    type:"POST",
    url:"HRMS/Question_Management/new.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })

}
function candicate_results()
{ 

//alert("bala");
$.ajax({
    type:"POST",
    url:"HRMS/Question_Management/candicate_results.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })

}
function question()
{
	//alert("gopi");
$.ajax({
    type:"POST",
    url:"HRMS/Question_Management/aptitude.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function candidate_form()
{
	$.ajax({
    type:"POST",
    url:"HRMS/candidate/candidate_form.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

function department_master()
{
	$.ajax({
    type:"POST",
    url:"HRMS/masters/department_master/department_master.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

function devision_master()
{
	$.ajax({
    type:"POST",
    url:"HRMS/masters/devision_master/devision_master.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

function designation_master()
{
	$.ajax({
    type:"POST",
    url:"HRMS/masters/designation_master/designation_master.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function interview_rounds()
{
	$.ajax({
    type:"POST",
    url:"HRMS/masters/interview_rounds/interview_rounds.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function interview_rounds_mapping()
{
	$.ajax({
    type:"POST",
    url:"HRMS/masters/interview_rounds_mapping/interview_rounds_mapping.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function department_mapping()
{
	
	$.ajax({
    type:"POST",
    url:"HRMS/masters/department_mapping/department_mapping.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function company_master()
{
	$.ajax({
    type:"POST",
    url:"HRMS/masters/company_master/company_master.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
} 
function candidate_details()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/applicationform/view.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
//assesment 
function assesment_question()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/assesment_question/assesment_question.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function cost_sheet_approval()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/CRM/cost_sheet_approval.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function question_name()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/assesment/question_name.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function section_master()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/assesment/section_master.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function assessment_employee()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/assessment_candidate/assessment_emp_list.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function emp_assessment_question()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/assesment_question/empwise_assesment_qn.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function assessment_result()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/assesment_question/candidate_results.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Payoll_generation()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/payroll/payroll_process/payroll_generation.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Deduction()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/payroll/deduction.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function leaves()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/payroll/leaves.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function holidays()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/payroll/holiday.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function od()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/payroll/od.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function reports()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/payroll/payroll_reports.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Payroll_close()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/payroll/payroll_close.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function deduction()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/payroll/deduction/deduction_esi.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Attendance()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/attendance/attendance.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function pay_slip()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/payroll/payslip/payslip_main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function document_approve()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/HRMS/document_view_list.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function staff_list()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/Recruitment/staff/staff_list.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function staff_asset()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/Recruitment/staff_asset/staff_asset.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

function staff_asset_master()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/Recruitment/staff_asset_master/staff_asset_master.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function hod()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/Recruitment/hod/hod.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function birthday_list()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/Recruitment/birthday_list/index.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function enquiry()
{  

	$.ajax({
    type:"POST",
    url:"HRMS/CRM/enquiry.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function client_master()
{
	$.ajax({
    type:"POST",
    url:"HRMS/masters/client_master/client_master.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
} 
function lead()
{  

	$.ajax({
    type:"POST",
    url:"HRMS/CRM/proposal.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Quotation()
{  

	$.ajax({
    type:"POST",
    url:"HRMS/BusinessProcess/quotation/quatation_list.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Quotation_view()
{  

	$.ajax({
    type:"POST",
    url:"HRMS/BusinessProcess/quotation/quatation_view.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Quotation_send()
{  

	$.ajax({
    type:"POST",
    url:"HRMS/BusinessProcess/quotation/quotation_send_list.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function interview_candidate_list()
{  

	$.ajax({
    type:"POST",
    url:"HRMS/candidate/candidate_list.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Product_master()
{  

	$.ajax({
    type:"POST",
    url:"HRMS/masters/Product_master/product.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function service_master()
{  

	$.ajax({
    type:"POST",
    url:"HRMS/masters/Service_master/service.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function calls_master()
{  

	$.ajax({
    type:"POST",
    url:"HRMS/masters/Calls_master/calls.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

function resource_master()
{  

	$.ajax({
    type:"POST",
    url:"HRMS/masters/Resource_master/resource.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

function feedback_master()
{  

	$.ajax({
    type:"POST",
    url:"HRMS/masters/Feedback_master/feedback.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function vendor_master()
{  

	$.ajax({
    type:"POST",
    url:"HRMS/BusinessProcess/doller_vendor_master/vendor.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

function resource_form()
{
	$.ajax({
    type:"POST",
    url:"HRMS/resource/resource_form/resource_form.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function resource_list()
{
	$.ajax({
    type:"POST",
    url:"HRMS/resource/resource_form/resource_list.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function vms()
{
	$.ajax({
    type:"POST",
     url:"HRMS/Recruitment/vms.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Asset()
{
	$.ajax({
    type:"POST",
     url:"HRMS/Assets/assets.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function role()
{
	$.ajax({
    type:"POST",
     url:"HRMS/role/role.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function user_role()
{
	$.ajax({
    type:"POST",
     url:"HRMS/user_role/role.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function non_Asset()
{
	$.ajax({
    type:"POST",
     url:"HRMS/Assets/non_It.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function candidate_qn()
{
	$.ajax({
		type:"POST",
		url:"HRMS/candidate/candidwise_assesment_qn.php",
		success:function(data)
		{
			$("#main_content").html(data);
		}
	})
}
function cost()
{
	$.ajax({
		type:"POST",
	 url:"HRMS/CRM/cost.php",
		success:function(data)
		{
			$("#main_content").html(data);
		}
	})
}
function project()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/Recruitment/project_management/project/project.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function project_schedule()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/Recruitment/project_management/project_schedule/project_schedule.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function project_to_do_list()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/Recruitment/project_management/project_to_do_list/project_to_do_list.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function modules()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/Recruitment/project_management/modules/modules.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function completed_task()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/Recruitment/project_management/completed_task/completed_task.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

function prefix_code()
{  
	$.ajax({
    type:"POST",
    url:"HRMS/masters/Prefixcode_master/prefixcode.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

function birthday_wishes()
{
	//alert()
	/* $.ajax({
    type:"POST",
    url:"HRMS/birthday_wishes/birthday_wishes.php",
    success:function(data){
      $("#main_content").html(data);
    }
  }) */
  }

</script>
</body>
</html>