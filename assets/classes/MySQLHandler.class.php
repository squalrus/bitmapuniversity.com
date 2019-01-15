<?php

class MySQLHandler {

  // Change these variables to your own database settings
	var $DATABASE = 'db252633354';
	var $USERNAME = 'dbo252633354';
	var $PASSWORD = '63Md9u6b';
	var $SERVER = 'db1426.perfora.net';

	var $LOGFILE = "c:/mysql.log"; // full path to debug LOGFILE. Use only in debug mode!
	var $LOGGING = false; // debug on or off
	var $SHOW_ERRORS = true; // output errors. true/false
	var $USE_PERMANENT_CONNECTION = false;

  // Do not change the variables below
	var $CONNECTION;
	var $FILE_HANDLER;
	var $ERROR_MSG = '';


	function MySQLHandler() {
	}

###########################################
# Function:    init
# Parameters:  N/A
# Return Type: boolean
# Description: initiates the MySQL Handler
###########################################
	function init() {
		$this->logfile_init();
		if ($this->OpenConnection()) {
		return true;
		} else {
			return false;
		}
	}

###########################################
# Function:    OpenConnection
# Parameters:  N/A
# Return Type: boolean
# Description: connects to the database
###########################################
	function OpenConnection()	{
		if ($this->USE_PERMANENT_CONNECTION) {
			$conn = mysql_pconnect($this->SERVER,$this->USERNAME,$this->PASSWORD);
		} else {
			$conn = mysql_connect($this->SERVER,$this->USERNAME,$this->PASSWORD);
		}
		if ((!$conn) || (!mysql_select_db($this->DATABASE,$conn))) {
			$this->ERROR_MSG = "\r\n" . "Unable to connect to database - " . date('H:i:s');
			print "\r\n" . "Unable to connect to database - " . date('H:i:s');
			$this->debug();
			return false;
		} else {
			$this->CONNECTION = $conn;
			return true;
		}
	}

###########################################
# Function:    CloseConnection
# Parameters:  N/A
# Return Type: boolean
# Description: closes connection to the database
###########################################
	function CloseConnection() {
		if (mysql_close($this->CONNECTION)) {
			return true;
		} else {
			$this->ERROR_MSG = "\r\n" . "Unable to close database connection - " . date('H:i:s');
			$this->debug();
			return false;
		}
	}

###########################################
# Function:    logfile_init
# Parameters:  N/A
# Return Type: N/A
# Description: initiates the logfile
###########################################
	function logfile_init() {
		if ($this->LOGGING) {
			$this->FILE_HANDLER = fopen($this->LOGFILE,'a') ;
			$this->debug();
		}
	}
	
###########################################
# Function:    logfile_close
# Parameters:  N/A
# Return Type: N/A
# Description: closes the logfile
###########################################
	function logfile_close() {
		if ($this->LOGGING) {
			if ($this->FILE_HANDLER) {
				fclose($this->FILE_HANDLER) ;
			}
		}
	}

###########################################
# Function:    debug
# Parameters:  N/A
# Return Type: N/A
# Description: logs and displays errors
###########################################
	function debug() {
		if ($this->SHOW_ERRORS) {
			echo $this->ERROR_MSG;
		}
		if ($this->LOGGING) {
			if ($this->FILE_HANDLER) {
				fwrite($this->FILE_HANDLER,$this->ERROR_MSG);
			} else {
				return false;
			}
		}
	}

###########################################
# Function:    Insert
# Parameters:  sql : string
# Return Type: integer
# Description: executes a INSERT statement and returns the INSERT ID
###########################################
	function Insert($sql) {
		if ((empty($sql)) || (!eregi("^insert",$sql)) || (empty($this->CONNECTION))) {
			$this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> or not an INSERT - " . date('H:i:s');
			$this->debug();
			return false;
		} else {
			$conn = $this->CONNECTION;
			$results = mysql_query($sql,$conn);
			if (!$results) { 
				$this->ERROR_MSG = "\r\n" . mysql_error()." - " . date('H:i:s');
				$this->debug();
				return false;
			} else {
				$result = mysql_insert_id();
				return $result;
			}
		}
	}

###########################################
# Function:    Select
# Parameters:  sql : string
# Return Type: array
# Description: executes a SELECT statement and returns a
#              multidimensional array containing the results
#              array[row][fieldname/fieldindex]
###########################################
	function Select($sql)	{
		if ((empty($sql)) || (!eregi("^select",$sql)) || (empty($this->CONNECTION))) {
			$this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> or not a SELECT - " ;
			$this->debug();
			return false;
		} else {
			$conn = $this->CONNECTION;
			$results = mysql_query($sql,$conn);
			if ((!$results) || (empty($results))) {
				$this->ERROR_MSG = "\r\n" . mysql_error()." - " . date('H:i:s');
				$this->debug();
				return false;
			} else {
				$i = 0;
				$data = array();
				while ($row = mysql_fetch_array($results)) {
					$data[$i] = $row;
					$i++;
				}
				mysql_free_result($results);
				return $data;
			}
		}
	}

	function SelectSimilar($sql,$formField,$col){
		if ((empty($sql)) || (!eregi("^select",$sql)) || (empty($this->CONNECTION))) {
			$this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> or not a SELECT - " . date('H:i:s');
			$this->debug();
			return false;
		} else {
			$conn = $this->CONNECTION;
			$results = mysql_query($sql,$conn);
			if ((!$results) || (empty($results))) {
				$this->ERROR_MSG = "\r\n" . mysql_error()." - " . date('H:i:s');
				$this->debug();
				return false;
			} else {
				$i = 0;
				$data = array();
//				while ($row = mysql_fetch_array($results)) {
//					$data[$i] = $row;
//					$i++;
//				}
				while ($row = mysql_fetch_array($results)) {
					similar_text(strtoupper($formField), strtoupper($row[$col]), $similarity_pst);
					if (number_format($similarity_pst, 0) > 90){
						$data[$i] = $row;
						$i++;
//						$too_similar = $row['reserved'];
//						print "The name you entered is too similar the reserved name &quot;".$row['reserved']."&quot;";
//						break;
					}
				}
				mysql_free_result($results);
				return $data;
			}
		}
	}
###########################################
# Function:    Update
# Parameters:  sql : string
# Return Type: integer
# Description: executes a UPDATE statement 
#              and returns number of affected rows
###########################################
	function Update($sql)	{
		if ((empty($sql)) || (!eregi("^update",$sql)) || (empty($this->CONNECTION))) {
			$this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> or not an UPDATE - " . date('H:i:s');
			$this->debug();
			return false;
		} else {
			$conn = $this->CONNECTION;
			$results = mysql_query($sql,$conn);
			if (!$results) { 
				$this->ERROR_MSG = "\r\n" . mysql_error()." - " . date('H:i:s');
				$this->debug();
				return false;
			} else {
				return mysql_affected_rows();
			}
		}
	}
  
###########################################
# Function:    Replace
# Parameters:  sql : string
# Return Type: boolean
# Description: executes a REPLACE statement 
###########################################
	function Replace($sql) {
		if ((empty($sql)) || (!eregi("^replace",$sql)) || (empty($this->CONNECTION))) {
			$this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> or not a REPLACE - " . date('H:i:s');
			$this->debug();
			return false;
		} else {
			$conn = $this->CONNECTION;
			$results = mysql_query($sql,$conn);
			if (!$results) { 
				$this->ERROR_MSG = "\r\n" . "Error in SQL Statement : ($sql) - " . date('H:i:s');
				$this->debug();
				return false;
			} else {
				return true;
			}
		}
	}  

###########################################
# Function:    Delete
# Parameters:  sql : string
# Return Type: boolean
# Description: executes a DELETE statement 
###########################################
	function Delete($sql)	{
		if ((empty($sql)) || (!eregi("^delete",$sql)) || (empty($this->CONNECTION))) {
			$this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> or not a DELETE - " . date('H:i:s');
			$this->debug();
			return false;
		} else {
			$conn = $this->CONNECTION;
			$results = mysql_query($sql,$conn);
			if (!$results) { 
				$this->ERROR_MSG = "\r\n" . mysql_error()." - " . date('H:i:s');
				$this->debug();
				return false;
			} else {
				return true;
			}
		}
	}
  
###########################################
# Function:    Query
# Parameters:  sql : string
# Return Type: boolean
# Description: executes any SQL Query statement 
###########################################
	function Query($sql)	{
		if ((empty($sql)) || (empty($this->CONNECTION))) {
			$this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> - " . date('H:i:s');
			$this->debug();
			return false;
		} else {
			$conn = $this->CONNECTION;
			$results = mysql_query($sql,$conn);
			if (!$results) { 
				$this->ERROR_MSG = "\r\n" . mysql_error()." - ";
				$this->debug();
				return false;
			} else {
				return true;
			}
		}
	}
}
?>
