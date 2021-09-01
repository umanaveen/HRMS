<?php 
require("../../configuration.php");
require("../../user.php");
$user=$_SESSION['user'];
//$start_date=$_REQUEST['from_date'];
//$end_date=$_REQUEST['to_date'];

	
	//daybook deletion
$delete_query=mysql_query("Delete FROM `daybook`");

	//daybook Insert
$insert_query=mysql_query("INSERT INTO DAYBOOK 
select t1.id,t1.reference,t1.search_no,t1.date as date,t1.ledger_code,t1.name,narration,sum(case when t1.type='Cash Receipt' then t1.amount else 0 end) as Cash_Receipt,sum(case when t1.type='Adjustment Receipt' then t1.amount else 0 end) as Adjustment_Receipt,sum(case when t1.type='Cash Payment' then t1.amount else 0 end) as Cash_Payment, sum(case when t1.type='Adjustment Payment' then t1.amount else 0 end) as Adjustment_Payment from (

select a.id,reference,search_no,date,ledger_code,l.name,narration,amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
    when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type  from account_entry a join ledger l on l.code=a.ledger_code where   main_entity like '%Cash Voucher%'  and ledger_code not in ('Z001')
			
            union
			SELECT a.id,member_no as reference,v.name as search_no,a.date,a.ledger_code,l.name,'Fd Interest Payable',sum(a.amount),
			case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
			when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
			When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
			when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type1 FROM account_entry a left join voucher v on a.reference=v.code join ledger l on l.code=a.ledger_code where a.ledger_code in ('P003','L002','L003') and  a.narration in ('Fd Interest Payable','Fixed Deposit Interest Payable','FD RENEWAL','FD renewal so old fd is closed') group by member_no,v.name,l.name,a.date,v.name,type1
            union
            select a.id,reference,search_no,date,ledger_code,l.name,narration,amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
    when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type  from account_entry a join ledger l on l.code=a.ledger_code where   main_entity not like '%Cash Voucher%'  and ledger_code not in ('F007','Z001','G001','G002','G003','G004','C001','E003','L002','L001','U001','U002','U003','U004','U005','U006','D001','F001','A003','F002','H001','P003','O022','O017','P004','D002','P001')

union
SELECT '','','',date,'G001','SURETY LOAN',(CASE WHEN main_entity='loan' THEN 'AS PER LDR'
WHEN (main_entity='DEMAND COLLECTION' || main_entity='voucher') && (main_entity_type='ADJUSTMENT RECEIPT' || main_entity_type='EXCESS COLLECTION' || main_entity_type='FULL COLLECTION' || main_entity_type='LESS COLLECTION')THEN 'AS PER COL'
ELSE '' END) as narration,
sum(amount) as amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
    when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type
FROM account_entry WHERE (ledger_code='G001'||ledger_code='U001') AND main_entity_type<>'ADJUSTMENT SLIP'  and (main_entity='loan') group by type,'SURETY LOAN',date
union
SELECT '','','',date,'G001','SURETY LOAN',(CASE WHEN main_entity='loan' THEN 'AS PER LDR'
WHEN (main_entity='DEMAND COLLECTION' || main_entity='voucher') && (main_entity_type='ADJUSTMENT RECEIPT' || main_entity_type='EXCESS COLLECTION' || main_entity_type='FULL COLLECTION' || main_entity_type='LESS COLLECTION')THEN 'AS PER COL'
ELSE '' END) as narration,
sum(amount) as amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
    when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type
FROM account_entry WHERE (ledger_code='G001') AND main_entity_type<>'ADJUSTMENT SLIP'   and (main_entity<>'loan') group by type,'SURETY LOAN',date
union
SELECT '','','',date,'G002',' FESTIVAL LOAN',(CASE WHEN main_entity='loan' THEN 'AS PER LDR'
WHEN (main_entity='DEMAND COLLECTION' || main_entity='voucher') && (main_entity_type='ADJUSTMENT RECEIPT' || main_entity_type='EXCESS COLLECTION' || main_entity_type='FULL COLLECTION' || main_entity_type='LESS COLLECTION')THEN 'AS PER COL'
ELSE '' END) as narration,
sum(amount) as amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
    when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type
FROM account_entry WHERE (ledger_code='G002'||ledger_code='U002') and (main_entity='loan')  and  main_entity_type<>'ADJUSTMENT SLIP' group by type,' FESTIVAL LOAN',date
union
SELECT '','','',date,'G002',' FESTIVAL LOAN',(CASE WHEN main_entity='loan' THEN 'AS PER LDR'
WHEN (main_entity='DEMAND COLLECTION' || main_entity='voucher') && (main_entity_type='ADJUSTMENT RECEIPT' || main_entity_type='EXCESS COLLECTION' || main_entity_type='FULL COLLECTION' || main_entity_type='LESS COLLECTION')THEN 'AS PER COL'
ELSE '' END) as narration,
sum(amount) as amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
    when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type
FROM account_entry WHERE (ledger_code='G002' ) and (main_entity<>'loan')  and  main_entity_type<>'ADJUSTMENT SLIP' group by type,' FESTIVAL LOAN',date
union
SELECT '','','',date,'G003',' FIXED DEPOSIT LOAN',(CASE WHEN main_entity='loan' THEN 'AS PER LDR'
WHEN (main_entity='DEMAND COLLECTION' || main_entity='voucher') && (main_entity_type='ADJUSTMENT RECEIPT' || main_entity_type='EXCESS COLLECTION' || main_entity_type='FULL COLLECTION' || main_entity_type='LESS COLLECTION')THEN 'AS PER COL'
ELSE '' END) as narration,
sum(amount) as amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
    when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type
FROM account_entry WHERE (ledger_code='G003') AND main_entity_type<>'ADJUSTMENT SLIP' group by type,' FIXED DEPOSIT LOAN',date
union

SELECT '' as id,'' as reference,'' as search_no,date,'G004' as ledger_code,'FLOOD LOAN',(CASE WHEN main_entity='loan' THEN 'AS PER LDR'
WHEN (main_entity='DEMAND COLLECTION' || main_entity='voucher') && (main_entity_type='ADJUSTMENT RECEIPT' || main_entity_type='EXCESS COLLECTION' || main_entity_type='FULL COLLECTION' || main_entity_type='LESS COLLECTION')THEN 'AS PER COL'
ELSE '' END) as narration,
sum(amount) as amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
    when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type
FROM account_entry WHERE (ledger_code='G004'||ledger_code='U003') and (main_entity='loan') AND main_entity_type<>'ADJUSTMENT SLIP' group by type,'FLOOD LOAN',date
union
SELECT '' as id,'' as reference,'' as search_no,date,'G004' as ledger_code,'FLOOD LOAN',(CASE WHEN main_entity='loan'  THEN 'AS PER LDR'
WHEN (main_entity='DEMAND COLLECTION' || main_entity='voucher') && (main_entity_type='ADJUSTMENT RECEIPT' || main_entity_type='EXCESS COLLECTION' || main_entity_type='FULL COLLECTION' || main_entity_type='LESS COLLECTION')THEN 'AS PER COL'
ELSE '' END) as narration,
sum(amount) as amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
    when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type
FROM account_entry WHERE (ledger_code='G004') and (main_entity<>'loan')AND main_entity_type<>'ADJUSTMENT SLIP' group by type,'FLOOD LOAN',date

union
SELECT '','','',date,'M005','STAFF LOAN',(CASE WHEN main_entity='loan' || main_entity='staff loan' THEN 'AS PER LDR'
WHEN (main_entity='DEMAND COLLECTION' || main_entity='voucher') && (main_entity_type='ADJUSTMENT RECEIPT' || main_entity_type='EXCESS COLLECTION' || main_entity_type='FULL COLLECTION' || main_entity_type='LESS COLLECTION')THEN 'AS PER COL'
ELSE '' END) as narration,
sum(amount) as amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
    when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type
FROM account_entry WHERE (ledger_code='M005'||ledger_code='U004' ) and (main_entity='loan' || main_entity='staff loan') AND main_entity_type<>'ADJUSTMENT SLIP' group by type,'STAFF LOAN',date
union
SELECT '','','',date,'E003',' SRF',(CASE WHEN main_entity='loan' || main_entity='staff loan' THEN 'AS PER LDR'
WHEN (main_entity='DEMAND COLLECTION' || main_entity='voucher') && (main_entity_type='ADJUSTMENT RECEIPT' || main_entity_type='EXCESS COLLECTION' || main_entity_type='FULL COLLECTION' || main_entity_type='LESS COLLECTION')THEN 'AS PER COL'
ELSE '' END) as narration,
sum(amount) as amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
    when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type
FROM account_entry WHERE (ledger_code='E003' or ledger_code='C001') AND main_entity_type not in ('ADJUSTMENT SLIP','Cash Payment') group by type,' SRF',date

union
SELECT '','','',date,ledger_code,l.name,(CASE WHEN main_entity='loan' || main_entity='staff loan' THEN 'AS PER LDR'
WHEN (main_entity='DEMAND COLLECTION' || main_entity='voucher') && (main_entity_type='ADJUSTMENT RECEIPT' || main_entity_type='EXCESS COLLECTION' || main_entity_type='FULL COLLECTION' || main_entity_type='LESS COLLECTION')THEN 'AS PER COL'
ELSE '' END) as narration,
sum(amount) as amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
when main_entity='Cash Voucher' and type='debit' then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type1
FROM account_entry a join ledger l on l.code=a.ledger_code WHERE ledger_code not in ('Z001','G001','G002','G003','G004','U001','U002','U003','U004','A001','P003','O001','E003','C001','Z005','B001','B003','I002','I001','M004','M005','M006','F004','F003','F010','F011','F012','F013','F015','G006','G007','G008','G009','K004','L003','L004') and   main_entity_type not in ('ADJUSTMENT SLIP','Renewal FD')  and main_entity <>'Cash Voucher' group by type1,date,ledger_code,l.name
union
SELECT a.id,reference,search_no,date,ledger_code,l.name,narration,amount,
case when main_entity='Cash Voucher' and type='credit' then 'Cash Receipt'
when main_entity='Cash Voucher' and type='debit'  then 'Cash Payment'
            When main_entity <> 'Cash Voucher' and type ='credit' then 'Adjustment Receipt'
            when  main_entity <> 'Cash Voucher' and type ='debit' then 'Adjustment Payment' end as Type
FROM account_entry a join ledger l on l.code=a.ledger_code WHERE main_entity_type='ADJUSTMENT SLIP'
and ((narration <> 'Fd Interest Payable' and narration <>'Fixed Deposit Interest Payable') or narration is null)
                                             
) 
t1  group by t1.reference,t1.search_no,t1.date,t1.ledger_code,t1.name,narration order by t1.date,t1.ledger_code,id");

if($insert_query)
{
echo 0;
}
else
{
echo 1;
}
?>


