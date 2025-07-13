create or replace view v_departments_employees 
as select e.emp_no, e.birth_date, e.first_name, e.last_name, e.gender, e.hire_date, de.dept_no, de.from_date, de.to_date, dp.dept_name 
from employees e join dept_emp de on de.emp_no = e.emp_no 
join departments dp on dp.dept_no = de.dept_no;

create or replace view v_departments_manager
as select e.emp_no, e.birth_date, e.first_name, e.last_name, e.gender, e.hire_date, de.dept_no, de.from_date, de.to_date, dp.dept_name 
from employees e join dept_manager de on de.emp_no = e.emp_no 
join departments dp on dp.dept_no = de.dept_no;

create or replace view v_employees_salaries
as select e.emp_no, e.birth_date, e.first_name, e.last_name, e.gender, e.hire_date,
s.salary, s.from_date, s.to_date
from employees e 
join salaries s on e.emp_no = s.emp_no; 

create or replace view v_departments_employees_male
as select * from v_departments_employees where gender = 'M';

create or replace view v_departments_employees_female
as select * from v_departments_employees where gender = 'F';

select 
    count(*) as countf, 
    cm.countm, 
    cf.dept_no 
from v_departments_employees_female as cf 
join (
    select count(*) as countm, dept_no 
    from v_departments_employees_male 
    group by dept_no
) as cm 
on cf.dept_no = cm.dept_no 
group by cf.dept_no, cm.countm;
