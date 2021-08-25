<script>
	// Search of voucher no using select method 
	// Datepicker 
	$(document).ready(function() {
		$('#datetimepicker').datetimepicker({
				format: "dd-MM-yyyy" 
		});
	});
	// Home voucher
	function home_voucher()
	{
		$('#voucher_home').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
		 $.ajax({
					type: "POST",
					url: "Accounts/new_voucher/voucher_cat.php",	 
					success: function(data){
								$('#voucher_home').html(data);	
										 }
					});	
	}
	// Edit against an voucher 
	function edit(code)
	{
		$('#newmember_adj_right').html('<br><div style="text-align: center;"><img src="images/loader/loader.gif"></div>');
		var voucher_code=code; 		
		$.ajax({
			type:'GET',
			data: 'voucher_code='+voucher_code,
			url: 'Accounts/new_voucher/Update/edit_voucher.php',
			success:function(data)
			{
				$('#newmember_adj_right').html(data);	
			}
		});
	}
	// View Against an voucher
	function view(voucher_code)
	{ 
	 $.ajax({
		type: "GET",
		data: 'voucher_code='+voucher_code,
		url: "Accounts/new_voucher/Voucher_Approve/voucherview.php",	 
		success: function(data)
		{
			$('#newmember_adj_right').html(data);	
		}
		});
	}
	// Search voucher No
	function voucher_search()
	{
		$('#voucher_home').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
		var sear_voucher_no=$('#search_voucher_no').val();
		var pur_id=1;
		if(sear_voucher_no=='')
		{
			alert('Please Enter a voucher no...!!!');
		}
		else{
		$('#voucher_home').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
		$.ajax({
		type: "GET",
		data: "vocuher_no="+sear_voucher_no+"&pur_id="+pur_id,
		url: "Accounts/new_voucher/voucher_search_view.php",	 
		success: function(data){
			$('#voucher_home').html(data);	
			}
		});	
		}
	}
</script>