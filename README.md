# Heritage-Foundation



The code is for a school project working with "stakeholders" on a dream product; we created a searchable database where users can input suggestions to change the information displayed and contained in the database.

With the Heritage Foundation Database software, you're in control. Utilizing an Application Platform Infrastructure, you can upload all associated files to the cloud server using a File Transfer Protocol. You have all your PHP files, folders with PDFs, and pictures on your local machine, as seen in the finalsubmission.zip folder, source code, and database. Within the platform, you can activate the port for data transfer and set up a password. Using the platform, FileZilla or an FTP application, you can input the provided server name, port, and password to connect to the cloud servers. Transfer files from your local machine into the cloud servers, leading to a directory linking those files to an established domain; you can create and register a domain within the platform. You have the power to follow the steps similar to those in the import database, such as setting up a database server within the platform and importing the provided database.

Once all files are uploaded, users must change the following lines of code within the dbheritageconnection.php file,  and use the provided connection sample PHP code from Ionos. 

$DATABASE_HOST = 'CHANGE';
$DATABASE_USER = 'CHANGE';
$DATABASE_PASS = 'CHANGE’;
$DATABASE_NAME = 'CHANGE';

Site Instructions

Users can visit the site https://hfdatabase.oswegohistoryrecords.org/ and input search credentials into our search page. Results will display, and the user can select a property. The user can also select to update the property and input information onto a sheet, which is then submitted to the database and stored in a separate table. 

Admins can log in using marykay as username and Oswegohistory1848! as password. Once there, they can select either update property or add a new property. After selection, a table will appear. The admin can scroll to the right and click add, which pulls up a new page displaying the details from the column. The admin can click submit, and the information will be updated on the main table. 



