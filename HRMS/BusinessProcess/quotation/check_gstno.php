get_payroll_list().then(results=>{
      var check_idcard_details = results[0];
      console.log(check_idcard_details);
      for(j=0; j<check_idcard_details.length; j++){
            async function payroll_list_data() {
              try{
                var IDCARDNO = check_idcard_details[j].IDCARDNO;
                console.log(IDCARDNO)
                
                  let pool = await sql.connect(config);
                  let payroll_query =await pool.request().query( `select distinct ECODE,CCODE,NEW_CODE,PRE_CODE,ENAME,WORK_ORDER_No,case when WAGE is Null then 0 else WAGE end as pd_wage, 
                  case when ALLOWANCE is Null then 0 else ALLOWANCE end as pd_allowance, case when INCENTIVE is Null then 0 else INCENTIVE 
                  end as pd_incentive from cpcl_employee_master where ECODE ='${IDCARDNO}'`);
                        return payroll_query.recordsets;
              }
              catch(error) {
                  console.log(error)
              }
            }
            payroll_list_data().then(result=>{
              var PayrollData = result[0];
              attendance_data.push(PayrollData);
              console.log(attendance_data);
              res.send(PayrollData);
            }); 
      } 
     });
