<?php 

	class Mysql {

		private $mysql_server_name = "localhost";
		private $mysql_username = "cqc";
		private $mysql_password = "CQCcqc123";
		private $mysql_database = "mirror"; 
		private $conn;

		public function __construct() {
			$this->conn=mysql_connect($this->mysql_server_name, $this->mysql_username,
                        $this->mysql_password);
			if (!$this->conn) {
				die("数据库连接失败");
			} else {
				mysql_select_db($this->mysql_database, $this->conn);
			}
			mysql_query("SET NAMES UTF8");
		}


		public function insertData($content, $table) {
			if (!$content) {
				echo "0";
				return;
			}
			$sql = 'insert into '. $table .'(content, time) values("%s", "%s")';
			$time = date("Y-m-d h:i:s", time());
			$sql = sprintf($sql, $content, $time);
			$result = mysql_query($sql, $this->conn);
			if ($result) {
				echo "1";
			} else {
				echo "0";
			}
		}

		public function getContent($table) {
			$sql = "select * from " . $table . " order by id desc limit 0,1";
			$result = mysql_query($sql, $this->conn);
			$result = mysql_fetch_assoc($result);
			if ($result) {
				return $result['content'];
			} else {
				echo "0";
			}

		}


	}
