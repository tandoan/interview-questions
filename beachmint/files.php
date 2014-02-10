<?php
/**
Create a php program that handles class "acme" that represents files and folders. The main objects are files & folders.

Implement interface for file listing of files and folders (listing a folder will list items in it)
Implement interfaces for delete method between files & folder. The delete for folder will delete recursively (implementation should be recursive for this delete).


Create exception for nonexistence of a file/folder, permission.
Create unit test to handle delete and file listing.

*/


class DoesNotExistException extends Exception{}
class IncorrectPermissionsException extends Exception{}


interface iListable{
	public function list();
}

interface iDeletable {
	public function delete();
}

class FileSystemNode implements iListable, iDeletable {
	private $name;
	private $canDelete;

	public function getName() {
		return $name;
	}
	public function getCanDelete() {
		return $canDelete;
	}

}

class File extends FileSystemNode {
	private $data; //some data

	public function list(){
		echo $this->getName()."\n";
	}

	public function delete(){
		if($this->getCanDelete()){
			//delete data, try to delete self?
		} else {
			throw new IncorrectPermissionsException();
		}
	}
}

class Folder extends FileSystemNode {
	private $data //an array of files

	public function list(){
		foreach($this->data as $fileSystemNode)
			echo $fileSystemNode->getName()."\n";
		}
	}

	public function delete(){
		if($this->getCanDelete()){
			//delete data, try to delete self?
			foreach($this->data as $fileSystemNode)
				echo $fileSystemNode->delete()."\n";
			}
		} else {
			throw new IncorrectPermissionsException();
		}
	}

}


class acme implements iListable, iDeletable {
	private $tree;  //array of nodes
	private $pathSeperator = '/';
	private $current; //pointer to the node in the tree

	public function list(){
		$this->current->list();
	}

	public function delete(){
		$this->current->delete();
		$this->current = $tree;
	}

	public function traverseTo($path){
		$tmp = $this->current;
		$pieces = explode($pathSeperator, $path);
		foreach($pieces as $p){
			if(isset($tmp[$p])){
				$tmp = $tmp[$p];
			} else {
				throw new DoesNotExistException();
			}
		}
		$this->current = $tmp;
	}
}