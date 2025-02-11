# Rhizome project

To gain experience working with SCRUM methodology, we assembled a team of five people (although we ended the project with only a team of 3), each with specific roles and responsibilities.

Our goal was to build an alternative version of the NexEd website. This website provides students with the ability to view personal information and progress, such as the number of completed modules. Additionally, coaches can also gain insight into the progress of students, including details about completed modules and other relevant data.

This project was built over the course of 4 weeks. We held a 15 minute standup every day, and a meeting with the "product owner" (played by a coach) at the end of every week.

We used the Tailwind CSS framework to help with the front-end developing process.

## Meet the team

### Son Bram van der Burg

Son is a back-end developer with experience in PHP and databases. As the SCRUM master for this project, he made sure everyone was working with SCRUM principles, ensuring smooth communication and efficient workflow throughout the development process.

[Website](https://vdburg.site/) | [Github](https://github.com/Penguin-09) | [LinkedIn](https://www.linkedin.com/in/son-bram/)

### Sven Hoeksema

Sven is a key member of the back-end team, bringing extensive experience in PHP and database management. Additionally, he has a solid understanding of HTML, CSS, and the Tailwind CSS framework, allowing him to effectively collaborate with the front-end team and provide support whenever needed.

[Website](https://snevver.github.io/) | [Github](https://github.com/Snevver) | [LinkedIn](https://www.linkedin.com/in/sven-hoeksema/)

### Wilkes Perea

Wilkes is a front-end developer with extensive experience in HTML, CSS, and the Tailwind CSS framework. He leveraged his expertise to design and implement an attractive theme for the website, ensuring a visually appealing user experience.

[Github](https://github.com/Queen018)

### Sybren Keizer

Sybren is a talented front-end developer with a deep understanding of large-scale projects and front-end development. He applied his expertise to help design and build an exceptional website.

[Github](https://github.com/sybrenkeizer)

### Jadon Trey Ferdinand Pierau

Jadon is a versatile full-stack developer with extensive experience in PHP, databases, and web development. His broad skill set enables him to seamlessly support both the front-end and back-end teams, contributing to the project's overall success.

[Github](https://github.com/technoViking32)

## Requirements

To run this website locally, you need to have a few things installed:

-   PHP (latest version)
-   XAMPP
-   Apache
-   MySQL

## How to run

To open this website in your browser, you first need to ensure that all the files required for the website to function properly are placed in a folder accessible to Apache. A convenient way to do this is to create a folder called 'reviews' within the folder of the 'Basis scrum project' module, and then place the folder containing this README inside it.

Next, you need to create the database that will store all the information that is required for the website to run. This can be easily done using XAMPP:

1. Ensure that XAMPP and the necessary programs are correctly installed. More details about this can be found in the Database Beginner assignment in NexEd.

2. Start Apache and MySQL by clicking 'Start' for both in XAMPP. If everything is working correctly, the names of both modules should turn green. If this does not happen, something likely went wrong.

3. Click 'Admin' for MySQL. A page should now open in your browser.

4. Click 'SQL' at the top of the page. Here, you can execute queries.

5. Locate the 'import.sql' file in the basis-scrum-project folder. Copy all the code in this file; these are the queries we will execute to create the database.

6. Paste the query into the large input field. Once the query is ready, click 'Go' to execute it.
   If everything has gone well, the database should now be created. Verify that everything has been set up correctly by checking for any errors.

Afterward, you can view the webpage by entering 'localhost' into your browser of choice. (If you have named it something other than 'localhost,' you need to enter the name you chose.) If everything is set up correctly, you should see a list of folders on your screen. If you created a 'reviews' folder as described earlier, navigate to that folder and find the 'index.php' file. Double-click it, and the webpage should open!
