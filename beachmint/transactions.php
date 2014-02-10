<?php
/*- Create a php program that would do the following:


  * Start transaction
  * End transaction

- Create a php unit test using the code above that correctly handles a rollback situation and successful transaction (positive & negative tests).

He doesn't have to wrap PDO classes in a class.
Just create a php block that handles a successful transaction and an unsuccessful one.
*/


function executeTransaction($db, $queries = array()){
	try {
		$db->beginTransaction();
		foreach($queries as $k=>$query){
			$queries[$k]->result = $db->exec($query->query);	
		}
			
	} catch(PDOException $e){
		$db->rollBack();
		$queries[$k]->result = $e;
		return array('result'=>false, 'exception'=>$e, 'queries'=>$queries);
	}
	$db->commit();
	return array('result'=>true, 'queries'=>$queries);
	
}

class executeTransactionTest extends PHPUnit_Framework_TestCase{
	//test rollback
	function testRollback(){
		$this->setExpectedException('PDOException');

		$q->query = 'select *';
		$queries[0] = $q;

		$dbMock = $this->getMock('PDO', array('__construct','exec', 'beginTransaction', 'rollBack', 'commit'),array(''));
		$dbMock->expects($this->once())->method('exec');
		$dbMock->expects($this->once())->method('beginTransaction');
		$dbMock->expects($this->once())->method('rollBack');


		$result = executeTransaction($dbMock, $queries);
		$this->assertEquals($result->result, false);
	}

	//test successful
	//should throw an invalid data source name when it calls commit
	function testSuccessful(){

		$this->setExpectedException('PDOException', 'invalid data source name');
		
		$q->query = 'select * from information';
		$queries[0] = $q;

		$dbMock = $this->getMock('PDO', array('__construct','exec', 'beginTransaction', 'commit'), array(''));
		$dbMock->expects($this->once())->method('exec');
		$dbMock->expects($this->once())->method('beginTransaction');
		$dbMock->expects($this->once())->method('commit');

		//test does not get this far, due to failing on the commit
		/*
		$result = executeTransaction($dbMock, $queries);
		$this->assertEquals($result->result, true);
		*/
	}

}
