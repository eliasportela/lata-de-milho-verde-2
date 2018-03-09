<?php

class model{

	public function ReadAll($table)
	{
		try{
			$sql = "SELECT * FROM $table";
			$db = new db();
			$db = $db->connect();

			$stmt = $db->query($sql);
			$customers = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;

			echo json_encode($customers);

		} catch(PDOException $e){
			echo '{"error": {"text": '.$e->getMessage().'}';
		}

	}

	public function Read($table,$par,$id)
	{
		try{
	        // Get DB Object
	        $sql = "SELECT * FROM $table where $par = $id";
	        $db = new db();
	        // Connect
	        $db = $db->connect();

	        $stmt = $db->query($sql);
	        $customer = $stmt->fetch(PDO::FETCH_OBJ);
	        $db = null;
	        echo json_encode($customer);
	    } catch(PDOException $e){
	        echo '{"error": {"text": '.$e->getMessage().'}';
	    }
	}

	public function Register($table,$dados)
	{
		try{
			//Montando o INSERT
			$sql = $this->MontarInsert($table,$dados);
	        // Get DB Object
	        $db = new db();
	        // Connect
	        $db = $db->connect();

	        $stmt = $db->prepare($sql);

	        $stmt->execute();

	        echo '{"notice": {"text": "Added"}';

	    } catch(PDOException $e){
	        echo '{"error": {"text": '.$e->getMessage().'}';
	    }
	}

	public function Update($table,$dados,$par)
	{
		try{
			$sql = $this->MontarUpdate($table,$dados,$par);
			//die(var_dump($sql));
	        // Get DB Object
	        $db = new db();
	        // Connect
	        $db = $db->connect();

	        $stmt = $db->prepare($sql);

	        $stmt->execute();

	        echo '{"notice": {"text": "Updated"}';

	    } catch(PDOException $e){
	        echo '{"error": {"text": '.$e->getMessage().'}';
	    }
	}

	public function Delete($table,$par,$id)
	{
		$sql = "DELETE FROM $table WHERE $par = $id";
		try{
	        // Get DB Object
	        $db = new db();
	        // Connect
	        $db = $db->connect();

	        $stmt = $db->prepare($sql);
	        $stmt->execute();
	        $db = null;
	        echo '{"notice": {"text": "Deleted"}';
	    } catch(PDOException $e){
	        echo '{"error": {"text": '.$e->getMessage().'}';
	    }
	}

	public function Query($sql)
	{
		try{
	        $db = new db();
	        // Connect
	        $db = $db->connect();

	        $stmt = $db->query($sql);
	        $customer = $stmt->fetch(PDO::FETCH_OBJ);
	        $db = null;
	        echo json_encode($customer);
	    } catch(PDOException $e){
	        echo '{"error": {"text": '.$e->getMessage().'}';
	    }
	}

	//montar insert pelo array
	public function MontarInsert($table,$dados)
	{
		//Montando o INSERT
		$value = "INSERT INTO $table (";
		foreach ($dados as $key => $dado) {
			$value .= $key;
			if ($dado != end($dados)){
		        $value .= ",";
			}
		}

		$value .= ") VALUES (";
		foreach ($dados as $key => $dado) {
			$value .= '"'.$dado.'"';
			if ($dado != end($dados)){
		        $value .= ",";
			}
		}
		$value .= ")";

		return $value;
	}

	//montar update pelo array
	public function MontarUpdate($table,$dados,$par)
	{
		//Montando o UPDATE
		$value = "UPDATE $table SET ";
		foreach ($dados as $key => $dado) {
			$value .= $key.' = "'.$dado.'"';
			if ($dado != end($dados)){
		        $value .= ", ";
			}
		}
		$value .= " WHERE ".key($par)." = ".$par[key($par)];

		return $value;
	}

}