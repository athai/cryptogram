-- Some CREATE VIEW commands to set up Cryptogram's MySQL database. 

CREATE VIEW IF NOT EXISTS UsersPhotos AS
SELECT CryptogramUsers.username, uploaded.pictureID
FROM CryptogramUsers, uploaded
WHERE CryptogramUsers.UserID=uploaded.UserID;
