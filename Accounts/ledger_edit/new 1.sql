update 
opening_balance_share sh,
opening_balance_srf sr,
opening_balance_thrift th,
opening_balance_surety su,
opening_balance_festival fe
set 
sh.balance='500',sh.od_balance='500',sh.modified_by='1',sh.modified_on=NOW(),
sr.balance='500',sr.od_balance='500',sr.modified_by='1',sr.modified_on=NOW(),
th.balance='500',th.od_balance='500',th.modified_by='1',th.modified_on=NOW(),
su.balance='500',su.od_balance='500',su.od_interest='500',su.modified_by='1',su.modified_on=NOW(),
fe.balance='500',fe.od_balance='500',fe.od_interest='500',fe.modified_by='1',fe.modified_on=NOW()
where 
sh.member_no=th.member_no and 
sh.member_no=sr.member_no and 
sh.member_no=su.member_no and 
sh.member_no=fe.member_no and 
sh.date=th.date and 
sh.date=sr.date and
sh.date=su.date and 
sh.date=fe.date and sh.member_no=2866 and sh.date='2018-04-01'