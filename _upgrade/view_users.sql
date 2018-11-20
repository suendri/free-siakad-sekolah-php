CREATE VIEW view_users AS
SELECT 
	u_uname, u_pass, level, u_nama FROM admin WHERE nonaktif='N'
UNION ALL 
SELECT 
	u_uname, u_pass, level, u_nama FROM guru WHERE nonaktif='N'
UNION ALL
SELECT 
	u_uname, u_pass, level, u_nama FROM siswa WHERE nonaktif='N'