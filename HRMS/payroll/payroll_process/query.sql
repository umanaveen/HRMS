			select 
	a.emp_no AS emp_no,
	a.shift_type AS shift_type,
	a.in_log_date AS in_log_date,
	dayname(a.in_log_date) AS log_day,
	wem.emp_name AS emp_name,
	wem.department_id AS department,
	wem.designation_id as design_id,
	b.out_log_date AS out_log_date,
	a.punch_in_time AS punch_in_time,
	b.punch_out_time AS punch_out_time,
	wsm.name AS name,
	wsm.from_time AS from_time,
	wsm.to_time AS to_time,
	timediff(b.punch_out_time,wsm.to_time) AS ot_hours,
	ots.normal_ot_amount,
	ots.sunday_ot_amount,
	ots.shift_continues_allowance
	from (select 
			emp_no AS emp_no,shift_type AS shift_type,
			cast(log_time as date) AS in_log_date,
			min(cast(log_time as time)) AS punch_in_time 
			from attendance where 
			(log_tpye = 'in') 
			group by emp_no,cast(log_time as date))a join 
			(select 
				emp_no AS emp_no,cast(log_time as date) AS out_log_date,max(cast(log_time as time)) AS punch_out_time from attendance where (log_tpye = 'out') group by emp_no,cast(log_time as date)) 
				b on a.emp_no = b.emp_no and a.in_log_date = b.out_log_date join 
				contractor_labour_master wem on a.emp_no = wem.emp_no join 
				woosu_shift_master wsm on a.shift_type = wsm.name 
				join 
				onroll_ot_structure ots on wem.designation_id = ots.designation_id
				
				
CREATE VIEW contract_labour_attendance_view AS select 
	a.emp_no AS emp_no,
	a.shift_type AS shift_type,
	a.in_log_date AS in_log_date,
	dayname(a.in_log_date) AS log_day,
	wem.emp_name AS emp_name,
	wem.con_name AS con_name,
	wem.department AS department,
    wem.skill_type as skill_type,
    wem.skill_amount as skill_amount,
	(SELECT normal_ot_amount FROM onroll_ot_structure where designation_id=19) as normal_ot_amount,
	b.out_log_date AS out_log_date,
	a.punch_in_time AS punch_in_time,
	b.punch_out_time AS punch_out_time,
	wsm.name AS name,
	wsm.from_time AS from_time,
	wsm.to_time AS to_time,
	timediff(b.punch_out_time,wsm.to_time) AS ot_hours
	from (Select 
			emp_code AS emp_no,
			cast(log_time as date) AS in_log_date,
			min(cast(log_time as time)) AS punch_in_time 
			from attendance where 
			(log_tpye = 'in') 
			group by emp_code,cast(log_time as date))a 
			join 
			(select emp_code AS emp_no,cast(log_time as date) AS out_log_date,max(cast(log_time as time)) AS punch_out_time from attendance where (log_tpye = 'out') group by emp_code,cast(log_time as date)) 
				b on a.emp_no = b.emp_no and a.in_log_date = b.out_log_date join 
				contractor_labour_master wem on a.emp_no = wem.emp_no join 
				woosu_shift_master wsm on a.shift_type = wsm.name
				
				
				
	CREATE VIEW qds_attendance_view	AS	
	select 
	a.emp_no AS emp_no,
	sm.emp_name AS emp_name,
	sm.dep_id AS dep_id,
	sm.div_id AS div_id,
	sm.design_id AS design_id,
	a.in_log_date AS in_log_date,
	dayname(a.in_log_date) AS log_day,
	b.out_log_date AS out_log_date,
	a.punch_in_time AS punch_in_time,
	b.punch_out_time AS punch_out_time,
	timediff(b.punch_out_time,'18:00:00') AS work_hours
	from (Select 
			emp_code AS emp_no,
			cast(log_time as date) AS in_log_date,
			min(cast(log_time as time)) AS punch_in_time 
			from attendance where 
			(log_tpye = 'in') 
			group by emp_code,cast(log_time as date))a 
			join 
			(select emp_code AS emp_no,cast(log_time as date) AS out_log_date,max(cast(log_time as time)) AS punch_out_time from attendance where (log_tpye = 'out') group by emp_code,cast(log_time as date)) 
				b on a.emp_no = b.emp_no and a.in_log_date = b.out_log_date
				join			
				staff_master sm on a.emp_no=sm.emp_code 
				
				
SELECT staff_id,
		case when leave_type_id = 1 THEN available_leave END as "Casual_Leave",
		case when leave_type_id = 2 THEN available_leave END as "Sick Leave",
		case when leave_type_id = 3 THEN available_leave END as "Privilege Leave" 
			  FROM leave_tracker where payroll_month = 7 group by staff_id
				
				


SELECT staff_id, leave_type_id, available_leave FROM leave_tracker  where payroll_month = 7

SELECT staff_id,c.emp_code,c.emp_name,
		MAX(case when leave_type_id = 1 THEN a.available_leave END) as "Casual_Leave",
		MAX(case when leave_type_id = 2 THEN a.available_leave END) as "Sick_Leave",
		MAX(case when leave_type_id = 3 THEN a.available_leave END) as "Privilege_Leave" 
			  FROM leave_tracker a join leave_master b on a.leave_type_id=b.id join staff_master c on a.staff_id=c.id where payroll_month = 7 group by staff_id


DELIMITER //
CREATE PROCEDURE staff_leave_master_crud(IN staff_id int,IN leave_type_id int,IN from_date date,IN to_date date,IN taken_days varchar(50),IN status int,OUT result int)
BEGIN
    INSERT INTO staff_leave_master(staff_id, leave_type_id, from_date, to_date, taken_days, status, created_by, created_on) VALUES (staff_id, leave_type_id, from_date, to_date, taken_days, status, 1, NOW());
END //
    
DELIMITER ;


DELIMITER //
CREATE PROCEDURE staff_salary_advance_tab(id int,date date,staff_id int,staff_name varchar(55),amount int,reason varchar(55),status int,created_by int)
BEGIN

INSERT INTO staff_salary_advance(date, staff_id, staff_name, amount, reason, status, created_by, created_on) VALUES (date,staff_id, staff_name, amount, reason, status,created_by,NOW());

END //
    
DELIMITER ;


DELIMITER //
CREATE STOREPROCEDURE application_name_insert(name varchar(55),status int,created_by int)
BEGIN

	INSERT INTO application_name_master(`name`,`status`,`created_by`) VALUES(name,status,created_by);
    
END //
    
DELIMITER ;







