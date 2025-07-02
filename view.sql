create or replace view v_departments_employees 
as select * from dept_emp join employees on dept_emp.emp_no = employees.emp_no 
join departments on dept_emp.dept_no = departments.dept_no;