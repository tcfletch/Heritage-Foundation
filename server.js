const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const cors = require('cors');
const { error } = require('console');


const app = express();


app.use(bodyParser.json());
app.use(cors());
//const connection ---unique to system change to your requirements
const connection = mysql.createConnection({
  host: '',
  user: '',
  password: '',
  database: ''
});
connection.connect((err)=>{
    if(!err)
        console.log('DB connection successful.');
    else
        console.log('DB connection failed',err);
});
// app.listen(3000,()=>console.log('Express server is running at port no: 3000'));
 
//Get the form data from client side
//run the query function
//show results
app.post('/dbsearch/form', (req, res) => {
    const formData = req.body;
    console.log('Received form data:',formData);
    // res.json({ formData });
    const query = createQuery(formData);


    connection.query(query, (error,results)=>{
        if (error){
            console.error('Error:',error);
            res.status(500).json({error: 'Error in executing occurred', error});
        } else {
            res.json(results);
        }
    });
});


app.get('/dbsearch/form', (req,res) =>{
    const queryParams = req.query;


  // Param function for query
  const query = createQuery(queryParams);


  connection.query(query, (error, results) => {
    if (error) {
      console.error('ERROR:', error);
      res.status(500).json({ error: 'Execution error has occurred' });
    } else {
      // Send the query results back to the client
      res.json(results);
    }
  });


});


function createQuery(data) {


    let query = 'SELECT * FROM main_build WHERE 1=1'; // gotta build her
 
    if (data.streetName) {
      query += ` AND building_street LIKE '${data.streetName}'`;
    }
    if (data.streetNumber) {
      query += ` AND Building_Street_num LIKE '${data.streetNumber}'`;
    }
    if (data.Town) {
        query += ` AND building_town_city LIKE '${data.Town}'`;
      }
      if (data.lastName) {
        query += ` AND Owner_at_inventory_last_name LIKE '${data.lastName}'`;
      }
      if (data.historicalDistrict) {
        query += ` AND Historic_District LIKE '${data.historicalDistrict}'`;
      }
      if (data.village) {
        query += ` AND Building_Village LIKE '${data.village}'`;
      }
      if (data.stillExists) {
        query += ` AND still_exists LIKE '${data.stillExists}'`;
      }
      if (data.sideOfRoad) {
        query += ` AND side_of_street LIKE '${data.sideOfRoad}'`;
      }
      if (data.Architect) {
        query += ` AND Architect LIKE '${data.Architect}'`;
      }
      if (data.Style) {
        query += ` AND Architectural_Style LIKE '${data.Style}'`;
      }
    return query;
  }


  app.listen(3000, () => {
    console.log('Server is running on port 3000');
});


// app.post('/dbsearch/form', (req, res) => {
//     const formData = req.body; // Receive form data from client-side
//     const { streetName, streetNumber, Town, lastName, historicalDistrict, village, stillExists, sideOfRoad, Architect, Style } = formData;
//     console.log(formData);
//     // using individual values from form data
//         const query = `SELECT * FROM main_build WHERE building_street LIKE '${streetName}`;

       
//     //query below outputs blank arrays; is it because of the query?
//     const query = `SELECT * FROM main_build WHERE
//         building_street LIKE '${streetName}' AND
//         building_street_num LIKE '${streetNumber}' AND
//         building_town_city LIKE '${Town}' AND
//         Owner_at_inventory_last_name LIKE '${lastName}' AND
//         historic_district LIKE '${historicalDistrict}' AND
//         building_village LIKE '${village}' AND
//         still_exists LIKE '${stillExists}' AND
//         side_of_street LIKE '${sideOfRoad}' AND
//         Architect LIKE '${Architect}' AND
//         Architectural_Style LIKE '${Style}'`;


//     connection.query(query,(error,results)=>{
//         if (error) {
//             console.error('ERROR:', error);
//             res.status(500).json({ error: 'Execution error has occurred',error });
//         } else {
//             res.json(results);
//         }
//     });
// });


// //potential params tester; could utlize the string for a url
// app.get('/dbsearch', (req, res) => {
//     // get the parameters
//     const queryParams = req.query;


//     // default sql
//     let sqlQuery = 'SELECT * FROM `main_build` WHERE 1=1'; // Initial query


//     // go through each param individually
//     Object.keys(queryParams).forEach(key => {
//         if (queryParams[key] !== '') { // in case a param is empty
//             sqlQuery += ` AND ${key} = '${queryParams[key]}'`; //
//         }
//         console.log(queryParams[key]);
//     });
//     connection.query(sqlQuery, (err, rows, fields) => {
//         if (!err)
//             res.send(rows);
//         else
//             console.log(err);
//     });
// });









